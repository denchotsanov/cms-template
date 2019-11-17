<?php

namespace backend\controllers;

use backend\models\UserForm;
use backend\models\UserStatusUpdate;
use common\models\Language;
use denchotsanov\rbac\filter\AccessControl;
use denchotsanov\rbac\models\AssignmentModel;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends MainController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    '*' => ['GET', 'POST'],
                ],
            ],
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['assign-assigment', 'remove-assigment'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
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
        $modelAssigment = $this->findAssigment($id);

        $language = Language::getLanguages();
        $userModel = [
            'id' => $model->id,
            'username' => $model->username,
            'email' => $model->email,
            'avatar' => $model->getUserAvatarUrl(),
            'language' => $model->getProfile()->exists() ? $model->getProfile()->language : 'en',
            'name' => $model->getProfile()->exists() ? $model->getProfile()->name : '',
            'blockedUser' => ($model->status === User::STATUS_BANED || $model->status === User::STATUS_LOCKED),
        ];
        return $this->render('view', [
            'model' => $model,
            'language'=>$language,
            'modelAssigment' => $modelAssigment,
            'user' => $userModel,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->renderAjax('create', ['model' => $model]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionStatusUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new UserStatusUpdate();
        $require = json_decode(Yii::$app->request->getRawBody(), true);
        $model->load($require);
        if ($model->update()) {
            return ['seccess' => 'OK'];
        } else {
            return ['seccess' => 'NOK'];
        }
    }

    public function actionCreateUser()
    {
        $model = new UserForm();
        $require = json_decode(Yii::$app->request->getRawBody(), true);
        $model->setAttributes($require);
        if ($model->validate()) {
            return $model->createNewUser();
        } else {
            return $model;
        }
    }

    /**
     * Assign items
     *
     * @param int $id
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionAssignAssigment(int $id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $assignmentModel = $this->findAssigment($id);
        $assignmentModel->assign($items);
        return $assignmentModel->getItems();
    }

    /**
     * Remove items
     *
     * @param int $id
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionRemoveAssigment(int $id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $assignmentModel = $this->findAssigment($id);
        $assignmentModel->revoke($items);
        return $assignmentModel->getItems();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function findAssigment($id)
    {
        $userClass = Yii::$app->user->identityClass;
        if (($userModel = $userClass::findIdentity($id)) !== null) {
            return new AssignmentModel($userModel);
        }

        throw new NotFoundHttpException(Yii::t('admin', 'The requested page does not exist.'));
    }
}
