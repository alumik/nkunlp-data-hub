<?php

namespace app\models;

use yii\db\ActiveRecord;

class DriveMgmt extends ActiveRecord
{
    public static function tableName()
    {
        return 'drive_mgmt';
    }

    public function rules()
    {
        return [
            [['name', 'location', 'notes'], 'string'],
            [['updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '编号',
            'location' => '位置',
            'notes' => '备注',
            'updated_at' => '修改时间',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->updated_at = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }

    public static function getTotal($provider, $columnName)
    {
        $total = 0;
        foreach ($provider as $item) {
            $total += $item[$columnName];
        }
        return $total;
    }
}
