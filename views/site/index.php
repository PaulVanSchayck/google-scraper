<?php

/* @var $this yii\web\View */
/* @var $keywords string[] */
/* @var $dataProvider ArrayDataProvider */

use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = 'Google Scraper';
?>
<div class="site-index">

    <?php $form = ActiveForm::begin(['method' => 'get']); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'keyword')->widget(Select2::classname(), [
                'data' => $keywords,
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Select a keyword ...'],
           ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= Html::submitButton('View', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php if( $dataProvider != null): ?>
        <div class="panel panel-primary">
            <div class="panel-heading">Results</div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'title',
                        'link',

                    ]
                ]); ?>
            </div>
        </div>
    <?php endif ?>

</div>
