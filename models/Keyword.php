<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Keyword
 * @package app\models
 * @property string $keyword
 * @property string $urls
 */
class Keyword extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @param $url
     */
    public function setUrls($url)
    {
        $this->urls = serialize($url);
    }

    /**
     * @return string[]
     */
    public function getUrls()
    {
        return unserialize($this->urls);
    }
}