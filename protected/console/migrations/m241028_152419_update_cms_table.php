<?php

use yii\db\Migration;

/**
 * Class m241028_152419_update_cms_table
 */
class m241028_152419_update_cms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cms', 'community', $this->string()->notNull()->after('template'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241028_152419_update_cms_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241028_152419_update_cms_table cannot be reverted.\n";

        return false;
    }
    */
}
