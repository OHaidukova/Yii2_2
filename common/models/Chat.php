<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string $channel
 * @property string $message
 * @property int $user_id
 * @property string $created_at
 */
class Chat extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['channel', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel' => 'Channel',
            'message' => 'Message',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    public static function getChannelHistory($channel) {
        return static::find()
            ->where(['channel' => $channel])
            ->orderBy('created_at')
            ->all();
    }

//    public function behaviors() {
//        return [
//            'class' => TimestampBehavior::className(),
//            'createdAtAttribute' => 'created_at',
//            'updatedAtAttribute' => false,
//            'value' => new Expression('NOW()'),
//        ];
//    }

}