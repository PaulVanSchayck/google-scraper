<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ScrapeForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Scrape';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-scrape">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the keyword to scrape:</p>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'keyword') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= Html::submitButton('Scrape', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
