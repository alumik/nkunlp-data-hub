<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cc_filtering_filter".
 *
 * @property int $id
 * @property int $id_cc_filtering
 * @property int $id_cc_filter
 *
 * @property CcFilter $ccFilter
 * @property CcFiltering $ccFiltering
 */
class CcFilteringFilter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cc_filtering_filter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cc_filtering', 'id_cc_filter'], 'required'],
            [['id_cc_filtering', 'id_cc_filter'], 'integer'],
            [['id_cc_filtering', 'id_cc_filter'], 'unique', 'targetAttribute' => ['id_cc_filtering', 'id_cc_filter']],
            [['id_cc_filter'], 'exist', 'skipOnError' => true, 'targetClass' => CcFilter::className(), 'targetAttribute' => ['id_cc_filter' => 'id']],
            [['id_cc_filtering'], 'exist', 'skipOnError' => true, 'targetClass' => CcFiltering::className(), 'targetAttribute' => ['id_cc_filtering' => 'id']],
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
            'id_cc_filter' => 'Id Cc Filter',
        ];
    }

    /**
     * Gets query for [[CcFilter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcFilter()
    {
        return $this->hasOne(CcFilter::className(), ['id' => 'id_cc_filter']);
    }

    /**
     * Gets query for [[CcFiltering]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCcFiltering()
    {
        return $this->hasOne(CcFiltering::className(), ['id' => 'id_cc_filtering']);
    }
}
