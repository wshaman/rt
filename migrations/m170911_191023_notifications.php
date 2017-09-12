<?php

use yii\db\Migration;

/**
 * Class m170911_191023_notifications
 */
class m170911_191023_notifications extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'notify_email' => $this->boolean(),
            'notify_browser' => $this->boolean(),
        ]);
        $this->addForeignKey('user_profile_fk', '{{%profile}}', 'user_id', '{{%user}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170911_191023_notifications cannot be reverted.\n";

        return false;
    }
    */
}
