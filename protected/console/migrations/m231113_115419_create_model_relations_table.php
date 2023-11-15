<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%model_relations}}`.
 */
class m231113_115419_create_model_relations_table extends Migration
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
        
        $this->createTable('{{%model_relations}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'type_name' => $this->string(),
            'type_id' => $this->integer()->notNull(),
            'type_value' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%model_relations}}');
    }
}
