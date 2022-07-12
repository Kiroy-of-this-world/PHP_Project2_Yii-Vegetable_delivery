<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int|null $number
 * @property int|null $product_id
 * @property int|null $user_id
 * @property float|null $kol
 * @property float|null $cost
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $status
 *
 * @property Products $product
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'product_id', 'user_id'], 'integer'],
            [['kol', 'cost'], 'number'],
            [['address', 'phone', 'status'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер заказа',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'kol' => 'Количество, кг.',
            'cost' => 'Сумма, р/кг.',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
