<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $db = Yii::$app->getDb();
        $dbCommonCrawl = Yii::$app->get('dbCommonCrawl');
        $progress = [];

        $progress['dataDownload'] = [];
        $progress['dataDownload']['all'] = $dbCommonCrawl->createCommand("
            select count(*)
            from data
        ")->queryScalar();
        $progress['dataDownload']['finished'] = $dbCommonCrawl->createCommand("
            select count(*)
            from data
            where download_state = 2
        ")->queryScalar();

        $progress['chineseExtraction'] = [];
        $progress['chineseExtraction']['all'] = $db->createCommand("
            select count(*)
            from data
        ")->queryScalar();
        $progress['chineseExtraction']['finished'] = $db->createCommand("
            select count(*)
            from data
            where id_storage is not null
        ")->queryScalar();
        return $this->render('index', [
            'progress' => $progress,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
