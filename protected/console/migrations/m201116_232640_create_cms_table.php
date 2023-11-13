<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cms}}`.
 */
class m201116_232640_create_cms_table extends Migration
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

        $this->createTable('{{%cms}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'url_redirect' => $this->string(),
            'template' => $this->string(),
            'tags' => $this->string(),
            'photo_id' => $this->string(),
            'summary' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'content' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),

            'status' => $this->integer()->notNull()->defaultValue(0),
            'start_date' => $this->integer()->notNull(),
            'end_date' => $this->integer(),
            'meta_title' => $this->string()->notNull(),
            'meta_description' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            
            'lang' => $this->string()->notNull(),
            'lang_parent_id' => $this->integer(),

            'author' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-cms-photo',
            'cms',
            'photo_id'
        );

        $this->createIndex(
            'idx-cms-lang_parent',
            'cms',
            'lang_parent_id'
        );

        $this->createIndex(
            'idx-cms-author',
            'cms',
            'author'
        );

        $this->addForeignKey(
            'fk-cms-parent_lang',
            'cms',
            'lang_parent_id',
            'cms',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-cms-author',
            'cms',
            'author',
            'user',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cms}}');
    }
}
