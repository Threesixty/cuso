<?php

use yii\db\Migration;

/**
 * Class m240728_124130_update_event_table
 */
class m240728_124130_update_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('event', 'presentation', $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext')->after('address_detail'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240728_124130_update_event_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240728_124130_update_event_table cannot be reverted.\n";

        return false;
    }
    */
}
