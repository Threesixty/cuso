<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forum}}`.
 */
class m231113_115635_create_forum_table extends Migration
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
        
        $this->createTable('{{%forum}}', [
            'id' => $this->primaryKey(),
            'content' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'parent_id' => $this->integer()->notNull(),

            'author' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-forum-author',
            'forum',
            'author'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%forum}}');
    }
}
