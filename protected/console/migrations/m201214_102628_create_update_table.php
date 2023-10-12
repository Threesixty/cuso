<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%update}}`.
 */
class m201214_102628_create_update_table extends Migration
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

        $this->createTable('{{%update}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'action' => $this->string()->notNull(),
            'date' => $this->integer()->notNull(),
            'author' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-update-model_id',
            'update',
            'model_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%update}}');
    }
}
