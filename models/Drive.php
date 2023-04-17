<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string|null $location
 * @property string|null $description
 * @property int $updated_at
 * @property string $updated_at_formatted
 *
 * @property CcStorage[] $ccStorages
 */
class Drive extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'drive';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['updated_at'], 'integer'],
            [['name', 'location', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'location' => '存放位置',
            'description' => '描述',
            'updated_at' => '更新时间戳',
            'updatedAtFormatted' => '更新时间',
        ];
    }

    public function getCcStorages(): ActiveQuery
    {
        return $this->hasMany(CcStorage::class, ['id_drive' => 'id']);
    }

    public function getUpdatedAtFormatted(): string
    {
        return date('Y-m-d H:i:s', $this->updated_at);
    }
}
