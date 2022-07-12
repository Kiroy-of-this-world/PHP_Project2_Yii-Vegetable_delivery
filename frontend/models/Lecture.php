<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lecture".
 *
 * @property int $id
 * @property string $topic
 * @property string $number
 * @property string $name
 * @property string $content
 */
class Lecture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topic', 'number', 'name', 'content'], 'required'],
            [['content'], 'string'],
            [['topic', 'number', 'name'], 'string', 'max' => 255],
            [['topic'], 'unique'],
            [['number'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic' => 'Topic',
            'number' => 'Number',
            'name' => 'Name',
            'content' => 'Content',
        ];
    }
}
