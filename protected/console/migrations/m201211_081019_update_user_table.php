<?php

use yii\db\Migration;

/**
 * Class m201211_081019_update_user_table
 */
class m201211_081019_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'gender', $this->string()->notNull()->after('email'));
        $this->addColumn('{{%user}}', 'firstname', $this->string()->notNull()->after('gender'));
        $this->addColumn('{{%user}}', 'lastname', $this->string()->notNull()->after('firstname'));
        $this->addColumn('{{%user}}', 'role', $this->integer()->defaultValue(0)->after('lastname'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201211_081019_update_user_table cannot be reverted.\n";
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201211_081019_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
