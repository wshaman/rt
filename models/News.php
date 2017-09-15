<?php

namespace app\models;

use app\components\F;
use Yii;
use \yii\db\Expression;

/**
 * This is the model class for table "site".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $pre
 * @property string $content
 * @property int $status
 * @property string $created
 * @property string $updated
 * @property User $author
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'pre'], 'required'],
            [['content'], 'string'],
            [['status'], 'default', 'value' => null],
            [['status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 60],
            [['pre'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'pre' => Yii::t('app', 'Pre'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function beforeValidate()
    {
        $this->slug = F::simplify_string($this->title, true).'_'.$this->id;
        if(!$this->pre){
            $pre = strip_tags($this->content);
            if (strlen($pre) >= 120)
                $this->pre = substr($pre, 0,117) . '...';
            else
                $this->pre = $pre;
        }
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if(!$insert){
            $this->updated = new Expression('NOW()');
        }
        return parent::beforeSave($insert);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
