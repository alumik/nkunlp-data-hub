<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cc_filtering".
 *
 * @property int $id
 * @property int $id_cc_chinese_extraction
 * @property int|null $id_storage
 * @property string|null $started_at
 * @property string|null $finished_at
 *
 * @property CcChineseExtraction $ccChineseExtraction
 * @property CcStorage $storage
 * @property CcFilter[] $ccFilters
 */
class CcFiltering extends \yii\db\ActiveRecord
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_STARTED = 1;
    const STATUS_FINISHED = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_filtering';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cc_chinese_extraction'], 'required'],
            [['id_cc_chinese_extraction', 'id_storage'], 'integer'],
            [['started_at', 'finished_at'], 'safe'],
            [['id_cc_chinese_extraction'], 'unique'],
            [['id_cc_chinese_extraction'], 'exist', 'skipOnError' => true, 'targetClass' => CcChineseExtraction::className(), 'targetAttribute' => ['id_cc_chinese_extraction' => 'id']],
            [['id_storage'], 'exist', 'skipOnError' => true, 'targetClass' => CcStorage::className(), 'targetAttribute' => ['id_storage' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cc_chinese_extraction' => 'Id Cc Chinese Extraction',
            'id_storage' => 'Id Storage',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
        ];
    }

    /**
     * Gets query for [[CcChineseExtraction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcChineseExtraction()
    {
        return $this->hasOne(CcChineseExtraction::className(), ['id' => 'id_cc_chinese_extraction']);
    }

    /**
     * Gets query for [[Storage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStorage()
    {
        return $this->hasOne(CcStorage::className(), ['id' => 'id_storage']);
    }

    /**
     * Gets query for [[CcFilters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcFilters()
    {
        return $this->hasMany(CcFilter::className(), ['id' => 'id_cc_filter'])->viaTable('cc_filtering_filter', ['id_cc_filtering' => 'id']);
    }
}
