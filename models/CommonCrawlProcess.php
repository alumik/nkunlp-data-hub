<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class CommonCrawlProcess extends ActiveRecord
{
    public static function tableName()
    {
        return 'process';
    }

    public static function getDb()
    {
        return Yii::$app->get('dbCommonCrawl');
    }

    public function rules()
    {
        return [
            [['id_data'], 'required'],
            [['id_data', 'size', 'id_worker'], 'integer'],
            [['processed_at'], 'safe'],
            [['uri'], 'string', 'max' => 256],
            [['id_data'], 'unique'],
            [['uri'], 'unique'],
            [['id_data'], 'exist', 'skipOnError' => true, 'targetClass' => CommonCrawlData::class, 'targetAttribute' => ['id_data' => 'id']],
            [['id_worker'], 'exist', 'skipOnError' => true, 'targetClass' => CommonCrawlWorker::class, 'targetAttribute' => ['id_worker' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'Id Data',
            'size' => 'Size',
            'processed_at' => 'Processed At',
            'id_worker' => 'Id Worker',
            'uri' => 'Uri',
        ];
    }

    public function getData()
    {
        return $this->hasOne(CommonCrawlData::class, ['id' => 'id_data']);
    }

    public function getWorker()
    {
        return $this->hasOne(CommonCrawlWorker::class, ['id' => 'id_worker']);
    }
}
