<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cc_download".
 *
 * @property int $id
 * @property int $id_cc_data
 * @property int|null $id_storage
 * @property string|null $started_at
 * @property string|null $finished_at
 *
 * @property CcChineseExtraction $ccChineseExtraction
 * @property CcData $ccData
 * @property CcStorage $storage
 */
class CcDownload extends \yii\db\ActiveRecord
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_STARTED = 1;
    const STATUS_FINISHED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_download';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cc_data'], 'required'],
            [['id_cc_data', 'id_storage'], 'integer'],
            [['started_at', 'finished_at'], 'safe'],
            [['id_cc_data'], 'unique'],
            [['id_cc_data'], 'exist', 'skipOnError' => true, 'targetClass' => CcData::className(), 'targetAttribute' => ['id_cc_data' => 'id']],
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
            'id_cc_data' => 'Id Cc Data',
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
        return $this->hasOne(CcChineseExtraction::className(), ['id_cc_download' => 'id']);
    }

    /**
     * Gets query for [[CcData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcData()
    {
        return $this->hasOne(CcData::className(), ['id' => 'id_cc_data']);
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
}
