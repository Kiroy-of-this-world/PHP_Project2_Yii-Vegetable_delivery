<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%baskets}}`.
 */
class m220520_174625_create_baskets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%baskets}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%baskets}}');
    }
}
