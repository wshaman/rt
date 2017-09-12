<?php

use yii\db\Migration;

/**
 * Class m170911_221146_role
 */
class m170911_221146_role extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role_name', $this->string(20)->defaultValue('reader'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'role_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170911_221146_role cannot be reverted.\n";

        return false;
    }
    */
}
