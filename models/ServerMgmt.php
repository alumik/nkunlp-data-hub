<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "server_mgmt".
 *
 * @property int $id
 * @property string $server
 * @property int|null $id_device
 * @property string|null $task
 * @property string|null $notes
 * @property string $modified_at
 *
 * @property Device $device
 */
class ServerMgmt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'server_mgmt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['server'], 'required'],
            [['id_device'], 'integer'],
            [['notes'], 'string'],
            [['modified_at'], 'safe'],
            [['server'], 'string', 'max' => 15],
            [['task'], 'string', 'max' => 32],
            [['id_device'], 'unique'],
            [['id_device'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['id_device' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'server' => '服务器',
            'id_device' => '挂载的存储设备',
            'task' => '任务类型',
            'notes' => '详细信息',
            'modified_at' => '修改时间',
        ];
    }

    /**
     * Gets query for [[Device]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'id_device']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->modified_at = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }
}
