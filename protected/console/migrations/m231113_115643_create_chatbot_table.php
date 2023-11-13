<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chatbot}}`.
 */
class m231113_115643_create_chatbot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%chatbot}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'button_text' => $this->string(),
            'button_link' => $this->string(),
            'user_role' => $this->integer()->defaultValue(0),
            'reccurence' => $this->string(),
            'end_date' => $this->integer(),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'author' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chatbot}}');
    }
}
