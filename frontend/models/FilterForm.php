<?php

namespace frontend\models;

use yii;
use yii\base\Model;

class FilterForm extends Model
{
    public $filter;
    public function rules()
    {
        return [
            [['filter'], 'required','message'=>'Не заполнено поле'],
        ]; }
    }