<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $uri
 * @property int $id_year_month
 *
 * @property YearMonth $yearMonth
 * @property CcDownload $ccDownload
 * @property string $yearMonthStr
 */
class CcData extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cc_data';
    }

    public function rules(): array
    {
        return [
            [['uri'], 'required'],
            [['id_year_month'], 'integer'],
            [['uri'], 'string', 'max' => 255],
            [
                ['id_year_month'],
                'exist',
                'skipOnError' => true,
                'targetClass' => YearMonth::class,
                'targetAttribute' => ['id_year_month' => 'id']
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'uri' => 'URI',
            'id_year_month' => '归档月份 ID',
            'yearMonthStr' => '归档月份',
        ];
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

    public function getCcDownload(): ActiveQuery
    {
        return $this->hasOne(CcDownload::class, ['id_cc_data' => 'id']);
    }
}
