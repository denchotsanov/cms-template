<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

namespace backend\controllers;

use backend\models\UpdateProfileForm;
use backend\models\UserForm;
use Throwable;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'create',
                            'update',
                            'delete',
                            'index',
                            'ajax-create',
                            'update-profile'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    '*' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $userModel = [
            'username' => $model->username,
            'email' => $model->email,
            'avatar' => $model->getUserAvatarUrl(),
        ];
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
                'user' => $userModel,
            ]);
        }
        return $this->render('view', [
            'model' => $model,
            'user' => $userModel,
        ]);
    }

    public function actionUpdateProfile()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->redirect('index');
        }
        $model = new UpdateProfileForm();

        return $this->renderAjax('updateProfile', ['model' => $model]);
    }

    /**
     *
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->createNewUser()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('create', ['model' => $model]);

    }

    public function actionAjaxCreate()
    {
        $model = new UserForm();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                return [
                    'data' => [
                        'success' => true,
                        'model' => $model,
                        'message' => 'Record has been saved.',
                    ],
                ];
            } else {
                return [
                    'data' => [
                        'success' => false,
                        'model' => $model->getErrors(),
                        'message' => 'An error occurred. Unable to save record. ' . json_encode(Yii::$app->request->post()) . ' ' .
                            print_r($model->getAttributes(), true) . ' ' .
                            print_r($model->getErrors(), true),
                    ],
                ];
            }

        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     */
    protected function findModel($id): User
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
