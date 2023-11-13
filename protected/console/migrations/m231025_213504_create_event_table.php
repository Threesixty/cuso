<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m231025_213504_create_event_table extends Migration
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

        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'cms_id' => $this->integer()->notNull(),

            'start_datetime' => $this->integer(),
            'end_datetime' => $this->integer(),
            'type' => $this->string()->notNull(),

            'address' => $this->string(),
            'street_number' => $this->string(),
            'route' => $this->string(),
            'postal_code' => $this->string(),
            'locality' => $this->string(),
            'address_detail' => $this->string(),

            'program' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'synthesis' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),

            'prospect' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
