<?php

use yii\db\Migration;

/**
 * Class m240513_080631_update_event_table
 */
class m240513_080631_update_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('event', 'presential', $this->integer()->notNull()->defaultValue(0)->after('synthesis'));
        $this->addColumn('event', 'distance', $this->integer()->notNull()->defaultValue(1)->after('presential'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240513_080631_update_event_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240513_080631_update_event_table cannot be reverted.\n";

        return false;
    }
    */
}
