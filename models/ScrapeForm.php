<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ScrapeForm extends Model
{
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
