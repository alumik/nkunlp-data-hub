<?php

namespace app\controllers\info;

use app\models\CcChineseExtraction;
use app\models\CcData;
use app\models\CcDownload;
use app\models\CcFiltering;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProgressController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $progress = [];

        $progress['cc_data'] = CcData::find()->count();
        $progress['cc_download'] = CcDownload::find()->where(['status' => CcDownload::STATUS_FINISHED])->count();
        $progress['cc_chinese_extraction'] = CcChineseExtraction::find()
            ->where(['status' => CcChineseExtraction::STATUS_FINISHED])
            ->count();
        $progress['cc_filtering'] = CcFiltering::find()->where(['status' => CcFiltering::STATUS_FINISHED])->count();
//        $progress['cc_deduplication'] = CcDeduplication::find()
//            ->where(['status' => CcDeduplication::STATUS_FINISHED])
//            ->count();

        return $this->render('index', [
            'progress' => $progress,
        ]);
    }
}
