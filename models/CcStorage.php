<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $id_drive
 * @property int $id_year_month
 * @property string $prefix
 * @property string $path
 * @property int|null $size
 *
 * @property CcChineseExtraction[] $ccChineseExtractions
 * @property CcDeduplication[] $ccDeduplications
 * @property CcDownload[] $ccDownloads
 * @property CcFiltering[] $ccFilterings
 * @property Drive $drive
 * @property YearMonth $yearMonth
 * @property string $yearMonthStr
 */
class CcStorage extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cc_storage';
    }

    public function rules(): array
    {
        return [
            [['id_drive', 'prefix', 'path'], 'required'],
            [['id_drive', 'id_year_month', 'size'], 'integer'],
            [['prefix'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 1023],
            [
                ['id_drive'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Drive::class,
                'targetAttribute' => ['id_drive' => 'id'],
            ],
            [
                ['id_year_month'],
                'exist',
                'skipOnError' => true,
                'targetClass' => YearMonth::class,
                'targetAttribute' => ['id_year_month' => 'id'],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'id_drive' => '存储设备 ID',
            'id_year_month' => '月份 ID',
            'prefix' => '命名空间',
            'path' => '路径',
            'size' => '大小',
            'driveName' => '存储设备',
            'yearMonthStr' => '月份',
        ];
    }

    public function getCcChineseExtractions(): ActiveQuery
    {
        return $this->hasMany(CcChineseExtraction::class, ['id_storage' => 'id']);
    }

    public function getCcDeduplications(): ActiveQuery
    {
        return $this->hasMany(CcDeduplication::class, ['id_storage' => 'id']);
    }

    public function getCcDownloads(): ActiveQuery
    {
        return $this->hasMany(CcDownload::class, ['id_storage' => 'id']);
    }

    public function getCcFilterings(): ActiveQuery
    {
        return $this->hasMany(CcFiltering::class, ['id_storage' => 'id']);
    }

    public function getDrive(): ActiveQuery
    {
        return $this->hasOne(Drive::class, ['id' => 'id_drive']);
    }

    public function getYearMonth(): ActiveQuery
    {
        return $this->hasOne(YearMonth::class, ['id' => 'id_year_month']);
    }

    public function getYearMonthStr(): string
    {
        if ($this->yearMonth->year === 'N/A' || $this->yearMonth->month === 'N/A') {
            return 'N/A';
        }
        return $this->yearMonth->year . '-' . $this->yearMonth->month;
    }
}
