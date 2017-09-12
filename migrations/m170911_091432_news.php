<?php

use yii\db\Migration;

/**
 * Class m170911_091432_news
 */
class m170911_091432_news extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(60)->notNull(),
            'slug' => $this->string(60),
            'pre' => $this->string(120)->notNull(),
            'content' => $this->text(),
            'status' => $this->integer()->defaultValue(\app\components\Consts::STATUS_NEWS_DRAFT),
            'created' => $this->timestamp()->defaultExpression('NOW()'),
            'updated' => $this->timestamp(),
            'author_id' => $this->integer()
        ]);
        $this->addForeignKey('news_author__user_fk1', 'news', 'author_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
