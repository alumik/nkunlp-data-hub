<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class CommonCrawlWorker extends ActiveRecord
{
    public static function tableName()
    {
        return 'worker';
    }

    public static function getDb()
    {
        return Yii::$app->get('dbCommonCrawl');
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
        ];
    }

    public function getDatas()
    {
        return $this->hasMany(CommonCrawlData::class, ['id_worker' => 'id']);
    }

    public function getProcesses()
    {
        return $this->hasMany(CommonCrawlProcess::class, ['id_worker' => 'id']);
    }

    public static function allWorkers()
    {
        return self::find()
            ->select(['name', 'id'])
            ->orderBy('id')
            ->indexBy('id')
            ->column();
    }
}
