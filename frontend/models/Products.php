<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $category
 * @property string $sort
 * @property float $price
 * @property float $max_kol
 * @property string $image
 */
class Products extends \yii\db\ActiveRecord
{

    /**
     * Вспомогательный атрибут для загрузки изображения товара
     */
    public $upload;

    /**
     * Вспомогательный атрибут для удаления изображения товара
     */
    public $remove;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'sort', 'price', 'max_kol'], 'required'],
            [['price', 'max_kol'], 'number'],
            [['category', 'sort', 'image'], 'string', 'max' => 255],
            // атрибут image проверяем с помощью валидатора image
            ['image', 'image', 'extensions' => 'png, jpg, gif'],
            // вспомогательный атрибут remove помечаем как безопасный
            ['remove', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Категория',
            'sort' => 'Сорт',
            'price' => 'Цена, р/кг.',
            'max_kol' => 'Максимальное количесвто, кг.',
            'image' => 'Изображение',
        ];
    }

    /**
     * Загружает файл изображения товара
     */
    public function uploadImage() {
        if ($this->upload) { // только если был выбран файл для загрузки
            $name = md5(uniqid(rand(), true)) . '.' . $this->upload->extension;
            // сохраняем исходное изображение в директории source
            $source = Yii::getAlias('@webroot/images/products/source/' . $name);
            if ($this->upload->saveAs($source)) {
                return $name;
            }
        }
        return false;
    }

    /**
     * Удаляет старое изображение при загрузке нового
     */
    public static function removeImage($name) {
        if (!empty($name)) {
            $source = Yii::getAlias('@webroot/images/products/source/' . $name);
            if (is_file($source)) {
                unlink($source);
            }
        }
    }

    /**
     * Удаляет изображение при удалении товара
     */
    public function afterDelete() {
        parent::afterDelete();
        self::removeImage($this->image);
    }
}
