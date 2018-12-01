<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $number
 * @property string $name
 * @property string $details
 * @property int $id_developer
 * @property string $date_create
 * @property string $date_resolve
 * @property int $id_status
 * @property string $date_change
 * @property string $img
 *
 * @property User $developer
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'name'], 'required'],
            [['id_developer', 'id_initiator', 'id_status', 'id_project'], 'integer'],
            [['date_create', 'date_resolve', 'date_change'], 'safe'],
            [['number', 'name'], 'string', 'max' => 50],
            [['details'], 'string', 'max' => 500],
            [['img'], 'string', 'max' => 200],
            [['number'], 'unique'],
            [['id_developer'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_developer' => 'id']],
            [['id_initiator'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_initiator' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'name' => 'Name',
            'id_project' => 'Project',
            'details' => 'Details',
            'id_developer' => 'Id Developer',
            'id_initiator' => 'Id Initiator',
            'date_create' => 'Date Create',
            'date_resolve' => 'Date Resolve',
            'id_status' => 'Id Status',
            'date_change' => 'Date Change',
            'img' => 'Img',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeveloper()
    {
        return $this->hasOne(User::className(), ['id' => 'id_developer']);
    }

    public static function getTasksCurrentMonth()
    {
        return static::find()
            ->andWhere(['>', 'date_create', new Expression('LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH') ])
            ->andWhere(['<', 'date_create', new Expression('DATE_ADD(LAST_DAY(CURDATE()), INTERVAL 1 DAY)') ])
            ->all();

    }
}