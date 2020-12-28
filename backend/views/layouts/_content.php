<?php
/**
 * Created by PhpStorm.
 * User: Dencho Tsanov
 * Date: 8/2/2019
 * Time: 01:10 ч.
 */

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\Breadcrumbs;

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php if (isset($this->blocks['content-header'])) { ?>
                        <h1><?= $this->blocks['content-header'] ?></h1>
                    <?php } else { ?>
                        <h1>
                            <?php
                            if ($this->title !== null) {
                                echo Html::encode($this->title);
                            } else {
                                echo Inflector::camel2words(
                                    Inflector::id2camel($this->context->module->id)
                                );
                                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Optional description</small>' : '';
                            } ?>
                        </h1>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <?= Breadcrumbs::widget([
                        'tag' => 'ol',
                        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                        'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',
                        'options' => ['class' => 'breadcrumb float-sm-right'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

                    ]); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?= Alert::widget(); ?>
            <?= $content; ?>
        </div>
    </section>

</div><!-- /.content-wrapper -->
