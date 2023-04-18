<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $year
 * @property string $month
 * @property string $cc_code
 *
 * @property CcData[] $ccDatas
 * @property CcStorage[] $ccStorages
 */
class YearMonth extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'year_month';
    }

    public function rules(): array
    {
        return [
            [['year', 'month', 'cc_code'], 'required'],
            [['year', 'month', 'cc_code'], 'string', 'max' => 255],
            [['cc_code'], 'unique'],
            [['year', 'month'], 'unique', 'targetAttribute' => ['year', 'month']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'year' => '归档年份',
            'month' => '归档月份',
            'cc_code' => 'Common Crawl 编码',
        ];
    }

    public function getCcDatas(): ActiveQuery
    {
        return $this->hasMany(CcData::class, ['id_year_month' => 'id']);
    }

    public function getCcStorages(): ActiveQuery
    {
        return $this->hasMany(CcStorage::class, ['id_year_month' => 'id']);
    }
}
