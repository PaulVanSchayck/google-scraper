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
    private $results = [];

    /**
     * @var Google_Client
     */
    private $client;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['keyword'], 'required'],
            [['keyword'], 'string'],
            [['keyword'], 'unique', 'targetClass' => 'app\models\Keyword', 'targetAttribute' => 'keyword'],
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

    public function init()
    {
        $client = new Google_Client();
        $client->setApplicationName("scraper");
        $client->setDeveloperKey(Yii::$app->params['secret']['apikey']);

        $this->client = $client;
    }

    /**
     * @return bool
     */
    public function scrape()
    {
        $service = new Google_Service_Customsearch($this->client);

        for ($start = 1; $start < 20; $start += 10) {
            $results = $service->cse->listCse($this->keyword, [
                'cx' => '008046774896284021390:aqku2is5b2o',
                'num' => 10,
                'start' => $start
            ]);

            $r = array_map( function($a) {
                return [
                    'link' => $a['link'],
                    'title'  => $a['title']
                ];
            }, $results->getItems());

            $this->results = array_merge($this->results, $r);
        }

        return true;
    }

    public function getResults()
    {
        return $this->results;
    }
}
