<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cc_storage".
 *
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
 */
class CcStorage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_storage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_drive', 'prefix', 'path'], 'required'],
            [['id_drive', 'id_year_month', 'size'], 'integer'],
            [['prefix'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 1023],
            [['id_drive'], 'exist', 'skipOnError' => true, 'targetClass' => Drive::className(), 'targetAttribute' => ['id_drive' => 'id']],
            [['id_year_month'], 'exist', 'skipOnError' => true, 'targetClass' => YearMonth::className(), 'targetAttribute' => ['id_year_month' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_drive' => 'Id Drive',
            'id_year_month' => 'Id Year Month',
            'prefix' => 'Prefix',
            'path' => 'Path',
            'size' => 'Size',
        ];
    }

    /**
     * Gets query for [[CcChineseExtractions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcChineseExtractions()
    {
        return $this->hasMany(CcChineseExtraction::className(), ['id_storage' => 'id']);
    }

    /**
     * Gets query for [[CcDeduplications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcDeduplications()
    {
        return $this->hasMany(CcDeduplication::className(), ['id_storage' => 'id']);
    }

    /**
     * Gets query for [[CcDownloads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcDownloads()
    {
        return $this->hasMany(CcDownload::className(), ['id_storage' => 'id']);
    }

    /**
     * Gets query for [[CcFilterings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcFilterings()
    {
        return $this->hasMany(CcFiltering::className(), ['id_storage' => 'id']);
    }

    /**
     * Gets query for [[Drive]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrive()
    {
        return $this->hasOne(Drive::className(), ['id' => 'id_drive']);
    }

    /**
     * Gets query for [[YearMonth]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYearMonth()
    {
        return $this->hasOne(YearMonth::className(), ['id' => 'id_year_month']);
    }
}
