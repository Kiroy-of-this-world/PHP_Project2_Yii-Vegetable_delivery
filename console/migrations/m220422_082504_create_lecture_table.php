<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lecture}}`.
 */
class m220422_082504_create_lecture_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lecture}}', [
            'id' => $this->primaryKey(),
            'topic' => $this->string()->notNull()->unique(),
            'number' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull()->unique(),
            'content' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lecture}}');
    }
}
