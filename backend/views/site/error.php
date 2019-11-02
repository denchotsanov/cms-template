<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
$code = Yii::$app->response->statusCode;
$color = $code == '404' ? 'warning': 'danger';
?>
<div class="error-page">
    <h2 class="headline text-<?= $color ?> "> <?= $code ?></h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-<?= $color ?>"></i> Oops! <?= nl2br(Html::encode($message)) ?></h3>

        <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?php echo Url::home() ?>">return to dashboard</a> or try using the search form.
        </p>

        <form class="search-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-<?= $color ?>"><i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <!-- /.input-group -->
        </form>
    </div>
    <!-- /.error-content -->
</div>
