<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cc_chinese_extraction".
 *
 * @property int $id
 * @property int $id_cc_download
 * @property int|null $id_storage
 * @property string|null $started_at
 * @property string|null $finished_at
 *
 * @property CcDownload $ccDownload
 * @property CcStorage $storage
 * @property CcFiltering $ccFiltering
 */
class CcChineseExtraction extends \yii\db\ActiveRecord
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_STARTED = 1;
    const STATUS_FINISHED = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_chinese_extraction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cc_download'], 'required'],
            [['id_cc_download', 'id_storage'], 'integer'],
            [['started_at', 'finished_at'], 'safe'],
            [['id_cc_download'], 'unique'],
            [['id_cc_download'], 'exist', 'skipOnError' => true, 'targetClass' => CcDownload::className(), 'targetAttribute' => ['id_cc_download' => 'id']],
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
            'id_cc_download' => 'Id Cc Download',
            'id_storage' => 'Id Storage',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
        ];
    }

    /**
     * Gets query for [[CcDownload]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcDownload()
    {
        return $this->hasOne(CcDownload::className(), ['id' => 'id_cc_download']);
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
     * Gets query for [[CcFiltering]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcFiltering()
    {
        return $this->hasOne(CcFiltering::className(), ['id_cc_chinese_extraction' => 'id']);
    }
}
