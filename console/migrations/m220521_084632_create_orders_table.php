<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m220521_084632_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
            'kol' => $this->float(),
            'cost' => $this->float(),
            'address' => $this->string(),
            'phone' => $this->string(),
            'status' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
