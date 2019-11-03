<?php

/**
 * Created by PhpStorm.
 * User: DTSHOME
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
                    <?php } ?></div>
                <div class="col-sm-6">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['class' => 'breadcrumb float-sm-right'],
                        'tag' => 'ol',
                        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                        'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>'
                    ]); ?>
                </div>
            </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <?= Alert::widget(); ?>
        <?= $content; ?>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
