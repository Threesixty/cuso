<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m231113_105518_create_company_table extends Migration
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

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            
            'address_line1' => $this->string()->notNull(),
            'address_line2' => $this->string()->notNull(),
            'postal_code' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'country' => $this->string()->notNull(),

            'activity_area' => $this->string()->notNull(),
            'public' => $this->integer()->defaultValue(0),
            'size' => $this->integer()->notNull(),
            'licenses_count' => $this->integer()->notNull(),
            'membership_end' => $this->integer()->notNull(),
            'is_sponsor' => $this->integer()->defaultValue(0),

            'main_contact_name' => $this->string()->notNull(),
            'main_contact_email' => $this->string()->notNull(),
            'main_contact_phone' => $this->string()->notNull(),
            'billing_contact_name' => $this->string(),
            'billing_contact_email' => $this->string(),
            'billing_contact_phone' => $this->string(),
            'billing_platform' => $this->string(),

            'status' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-company-photo',
            'cms',
            'photo_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
    }
}
