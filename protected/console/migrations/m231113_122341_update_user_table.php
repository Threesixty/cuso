<?php

use yii\db\Migration;

/**
 * Class m231113_122341_update_user_table
 */
class m231113_122341_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'photo_id', $this->integer()->after('email'));
        $this->addColumn('user', 'company_id', $this->integer()->notNull()->after('lastname'));
        $this->addColumn('user', 'is_speaker', $this->integer()->defaultValue(0)->after('company_id'));
        $this->addColumn('user', 'phone', $this->string()->after('is_speaker'));
        $this->addColumn('user', 'mobile', $this->string()->after('phone'));
        $this->addColumn('user', 'department', $this->string()->after('mobile'));
        $this->addColumn('user', 'function', $this->string()->after('department'));
        $this->addColumn('user', 'decision_scope', $this->string()->after('function'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231113_122341_update_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231113_122341_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
