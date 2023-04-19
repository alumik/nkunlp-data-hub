<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string|null $parameters
 *
 * @property CcFiltering[] $ccFilterings
 */
class CcFilter extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cc_filter';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name', 'parameters'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'parameters' => '规则参数',
        ];
    }

    public function getCcFilterings(): ActiveQuery
    {
        return $this
            ->hasMany(CcFiltering::class, ['id' => 'id_cc_filtering'])
            ->viaTable('cc_filtering_filter', ['id_cc_filter' => 'id']);
    }
}
