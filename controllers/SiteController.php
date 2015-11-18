<?php

namespace app\controllers;

use app\models\Keyword;
use app\models\ScrapeForm;
use app\models\ViewForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\HttpException;

class SiteController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new ViewForm();
        $dataProvider = null;

        if ($model->load(Yii::$app->request->get()) && $model->validate()) {

            $k = Keyword::findOne(['keyword' => $model->keyword]);

            if ( $k ) {
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $k->getUrls(),
                    'pagination' => [
                        'pageSize' => 10,
                    ]
                ]);
            }
        }

        return $this->render('index', [
            'model' => $model,
            'keywords' => ArrayHelper::map(Keyword::find()->orderBy('keyword')->all(), 'keyword', 'keyword'),
            'dataProvider' => $dataProvider
        ]);
    }


    /**
     * @return string
     * @throws HttpException
     */
    public function actionScrape()
    {
        $model = new ScrapeForm();

        if (! ($model->load(Yii::$app->request->post()) && $model->validate())) {
            return $this->render('scrape', ['model' => $model]);
        }

        try {
            $model->scrape();
        } catch (\Google_Exception $e) {
            throw new HttpException(500, "Could not scrape Google");
        }

        $keyword = new Keyword([
            'keyword' => $model->keyword,
        ]);
        $keyword->setUrls($model->getResults());
        $keyword->save();

        return $this->redirect(['site/index']);

    }

}
