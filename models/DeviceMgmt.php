<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class DeviceMgmt extends ActiveRecord
{
    public static function tableName()
    {
        return 'device_mgmt';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['notes'], 'string'],
            [['updated_at'], 'safe'],
            [['name', 'archive', 'cc_code'], 'string', 'max' => 16],
            [['name'], 'unique'],
            [['archive', 'cc_code'], 'archiveCodeMatch'],
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->updated_at = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }

    public function archiveCodeMatch($attribute)
    {
        $archive = (new Query())
            ->select('archive')
            ->from('archive_cc_code')
            ->where(['cc_code' => $this->cc_code])
            ->scalar();
        if ($archive != $this->archive) {
            $this->addError($attribute, '归档月份和数据编码不匹配。');
        }
    }
}
