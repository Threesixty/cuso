<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%media}}`.
 */
class m201125_175159_create_media_table extends Migration
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

        $this->createTable('{{%media}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'alt' => $this->string(),
            'legend' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'path' => $this->string()->notNull(),
            'tags' => $this->string(),
            'link' => $this->string(),

            'lang' => $this->string()->notNull()->defaultValue('fr'),
            'lang_parent_id' => $this->integer(),

            'author' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%media}}');
    }
}
