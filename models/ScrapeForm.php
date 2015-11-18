<?php

namespace app\models;

use Google_Client;
use Google_Service_Customsearch;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class ScrapeForm extends Model
{
    /**
     * @var string
     */
    public $keyword;

    /**
     * @var array
     */
    private $results;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['keyword'], 'required'],
            [['keyword'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'keyword' => 'Keyword',
        ];
    }

    /**
     * @return bool
     */
    public function scrape()
    {
        $client = new Google_Client();
        $client->setApplicationName("scraper");
        $client->setDeveloperKey(Yii::$app->params['secret']['apikey']);

        $service = new Google_Service_Customsearch($client);
        $results = $service->cse->listCse($this->keyword, [
            'cx' => '008046774896284021390:aqku2is5b2o',
            'num' => 10
        ]);

        $this->results = ArrayHelper::getColumn($results->getItems(), 'link');

        return true;
    }

    public function getResults()
    {
        return $this->results;
    }
}
