<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string|null $parameters
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
}
