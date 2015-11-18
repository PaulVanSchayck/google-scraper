<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * Class ViewForm
 * @package app\models
 */
class ViewForm extends Model
{
    /**
     * @var string
     */
    public $keyword;

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
}
