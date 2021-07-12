<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property string $device_name
 *
 * @property ServerMgmt $serverMgmt
 * @property Storage[] $storages
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_name'], 'required'],
            [['device_name'], 'string', 'max' => 20],
            [['device_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_name' => 'Device Name',
        ];
    }

    /**
     * Gets query for [[ServerMgmt]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServerMgmt()
    {
        return $this->hasOne(ServerMgmt::className(), ['id_device' => 'id']);
    }

    /**
     * Gets query for [[Storages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStorages()
    {
        return $this->hasMany(Storage::className(), ['id_device' => 'id']);
    }

    public static function allDevices()
    {
        return self::find()
            ->select(['device_name', 'id'])
            ->orderBy('id')
            ->indexBy('id')
            ->column();
    }
}
