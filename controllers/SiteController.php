<?php

namespace app\controllers;

use app\models\Keyword;
use app\models\ScrapeForm;
use Yii;
use yii\filters\AccessControl;
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
        return $this->render('index');
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

        return $this->render('index');

    }

}
