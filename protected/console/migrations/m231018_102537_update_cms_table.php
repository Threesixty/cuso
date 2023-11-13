<?php

use yii\db\Migration;

/**
 * Class m231018_102537_update_cms_table
 */
class m231018_102537_update_cms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cms', 'type', $this->string()->notNull()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231018_102537_update_cms_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231018_102537_update_cms_table cannot be reverted.\n";

        return false;
    }
    */
}
