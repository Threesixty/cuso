<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%option}}`.
 */
class m201126_082914_create_option_table extends Migration
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

        $this->createTable('{{%option}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'options' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'options_contents' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),

            'lang' => $this->string()->notNull(),
            'lang_parent_id' => $this->integer(),

            'author' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-option-author',
            'option',
            'author'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%option}}');
    }
}
