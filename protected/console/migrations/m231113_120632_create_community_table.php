<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%community}}`.
 */
class m231113_120632_create_community_table extends Migration
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
        
        $this->createTable('{{%community}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'club' => $this->integer()->notNull(),
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
        $this->dropTable('{{%community}}');
    }
}
