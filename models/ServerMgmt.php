<?php

namespace app\models;

use yii\db\ActiveRecord;

class ServerMgmt extends ActiveRecord
{
    public static function tableName()
    {
        return 'server_mgmt';
    }

    public function rules()
    {
        return [
            [['server'], 'required'],
            [['notes'], 'string'],
            [['updated_at'], 'safe'],
            [['device'], 'string', 'max' => 16],
            [['server'], 'string', 'max' => 15],
            [['task'], 'string', 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'server' => '服务器',
            'device' => '挂载存储',
            'task' => '任务类型',
            'notes' => '任务状态',
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
}
