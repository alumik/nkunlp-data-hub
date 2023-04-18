<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cc_deduplication".
 *
 * @property int $id
 * @property int $id_cc_filtering
 * @property int|null $id_storage
 * @property string|null $started_at
 * @property string|null $finished_at
 *
 * @property CcFilter $ccFiltering
 * @property CcStorage $storage
 */
class CcDeduplication extends \yii\db\ActiveRecord
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_STARTED = 1;
    const STATUS_FINISHED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_deduplication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cc_filtering'], 'required'],
            [['id_cc_filtering', 'id_storage'], 'integer'],
            [['started_at', 'finished_at'], 'safe'],
            [['id_cc_filtering'], 'unique'],
            [['id_cc_filtering'], 'exist', 'skipOnError' => true, 'targetClass' => CcFilter::className(), 'targetAttribute' => ['id_cc_filtering' => 'id']],
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
            'id_cc_filtering' => 'Id Cc Filtering',
            'id_storage' => 'Id Storage',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
        ];
    }

    /**
     * Gets query for [[CcFiltering]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcFiltering()
    {
        return $this->hasOne(CcFilter::className(), ['id' => 'id_cc_filtering']);
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
