<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class CommonCrawlData extends ActiveRecord
{
    public static $processStateDict = [
        '0' => '待处理',
        '1' => '处理中',
        '2' => '处理完成',
        '3' => '处理失败'
    ];

    public static $downloadStateDict = [
        '0' => '待下载',
        '1' => '下载中',
        '2' => '下载完成',
        '3' => '下载失败'
    ];

    public static function tableName()
    {
        return 'data';
    }

    public static function getDb()
    {
        return Yii::$app->get('dbCommonCrawl');
    }

    public function rules()
    {
        return [
            [['uri'], 'required'],
            [['size', 'process_state', 'download_state', 'id_worker'], 'integer'],
            [['started_at', 'finished_at'], 'safe'],
            [['uri'], 'string', 'max' => 256],
            [['archive'], 'string', 'max' => 30],
            [['uri'], 'unique'],
            [['id_worker'], 'exist', 'skipOnError' => true, 'targetClass' => CommonCrawlWorker::class, 'targetAttribute' => ['id_worker' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uri' => 'URI',
            'size' => '文件大小',
            'started_at' => '下载开始时间',
            'finished_at' => '下载结束时间',
            'process_state' => '中文提取状态',
            'download_state' => '下载状态',
            'id_worker' => '终端标识',
            'archive' => '归档月份',
        ];
    }

    public function getWorker()
    {
        return $this->hasOne(CommonCrawlWorker::class, ['id' => 'id_worker']);
    }

    public function getProcess()
    {
        return $this->hasOne(CommonCrawlProcess::class, ['id_data' => 'id']);
    }

    public function processStateText()
    {
        return self::$processStateDict[strval($this->process_state)];
    }

    public function downloadStateText()
    {
        return self::$downloadStateDict[strval($this->download_state)];
    }
}
