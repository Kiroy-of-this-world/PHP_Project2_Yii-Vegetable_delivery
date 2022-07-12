<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m220510_233450_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string()->notNull(),
            'sort' => $this->string()->notNull(),
            'price' => $this->money()->notNull(),
            'max_kol' => $this->float()->notNull(),
            'photo' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
