<?php

namespace frontend\models;

use yii;
use yii\base\Model;

class SearchForm extends Model
{
    public $search;
    public function rules()
    {
        return [
            [['search'], 'required','message'=>'Не заполнено поле'],
            ['search', 'string', 'min' => 1],
        ]; }
    }