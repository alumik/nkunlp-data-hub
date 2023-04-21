<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $id_cc_chinese_extraction
 * @property int|null $id_storage
 * @property int|null $started_at
 * @property int|null $finished_at
 * @property int $status
 *
 * @property CcChineseExtraction $ccChineseExtraction
 * @property CcStorage $storage
 * @property string|null $startedAtFormatted
 * @property string|null $finishedAtFormatted
 * @property string $prefixAndPath
 */
class CcFiltering extends ActiveRecord
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_STARTED = 1;
    const STATUS_FINISHED = 2;

    public static function tableName(): string
    {
        return 'cc_filtering';
    }

    public function rules(): array
    {
        return [
            [['id_cc_chinese_extraction'], 'required'],
            [['id_cc_chinese_extraction', 'id_storage'], 'integer'],
            [['started_at', 'finished_at'], 'safe'],
            [['id_cc_chinese_extraction'], 'unique'],
            [
                ['id_cc_chinese_extraction'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CcChineseExtraction::class,
                'targetAttribute' => ['id_cc_chinese_extraction' => 'id'],
            ],
            [
                ['id_storage'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CcStorage::class,
                'targetAttribute' => ['id_storage' => 'id'],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'id_cc_chinese_extraction' => '中文提取任务 ID',
            'id_storage' => 'Id Storage',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'status' => '任务状态',
            'size' => '文件大小',
            'startedAtFormatted' => '任务开始时间',
            'finishedAtFormatted' => '任务结束时间',
            'driveName' => '存储设备',
            'prefixAndPath' => '存储路径',
        ];
    }

    public function getCcChineseExtraction(): ActiveQuery
    {
        return $this->hasOne(CcChineseExtraction::class, ['id' => 'id_cc_chinese_extraction']);
    }

    public function getStorage(): ActiveQuery
    {
        return $this->hasOne(CcStorage::class, ['id' => 'id_storage']);
    }

    public function getStartedAtFormatted(): ?string
    {
        if ($this->started_at === null) {
            return null;
        }
        return date('Y-m-d H:i:s', $this->started_at);
    }

    public function getFinishedAtFormatted(): ?string
    {
        if ($this->finished_at === null) {
            return null;
        }
        return date('Y-m-d H:i:s', $this->finished_at);
    }

    public function getPrefixAndPath(): string
    {
        return $this->storage->yearMonth->year
            . '-'
            . $this->storage->yearMonth->month
            . '/'
            . $this->storage->prefix
            . '/'
            . $this->storage->path;
    }
}
