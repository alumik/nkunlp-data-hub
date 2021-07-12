<?php

namespace app\models;

use yii\db\ActiveRecord;

class DeviceMgmt extends ActiveRecord
{
    public static function tableName()
    {
        return 'device_mgmt';
    }

    public function rules()
    {
        return [
            [['name', 'updated_at'], 'required'],
            [['notes'], 'string'],
            [['updated_at'], 'safe'],
            [['name', 'archive', 'cc_code'], 'string', 'max' => 16],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '存储设备名称',
            'archive' => '归档月份',
            'cc_code' => '数据编码',
            'notes' => '备注',
            'updated_at' => '修改时间',
        ];
    }
}
