<?php

use yii\db\Migration;

/**
 * Class m240817_123120_update_company_table
 */
class m240817_123120_update_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company', 'informations', $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext')->after('billing_platform'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240817_123120_update_company_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240817_123120_update_company_table cannot be reverted.\n";

        return false;
    }
    */
}
