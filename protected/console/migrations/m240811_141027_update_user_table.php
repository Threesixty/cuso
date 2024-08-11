<?php

use yii\db\Migration;

/**
 * Class m240811_141027_update_user_table
 */
class m240811_141027_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'presentation', $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext')->after('decision_scope'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240811_141027_update_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240811_141027_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
