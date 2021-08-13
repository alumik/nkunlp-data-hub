<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class InfoController extends Controller
{
    public function behaviors()
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

    public function actionProgress()
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

        $progress['filter'] = [];
        $progress['filter']['all'] = $progress['chineseExtraction']['all'];
        $progress['filter']['finished'] = $db->createCommand("
            select count(*)
            from filtered
        ")->queryScalar();

        return $this->render('progress', [
            'progress' => $progress,
        ]);
    }

    public function actionArchiveCcCode($ccCode = '', $archive = '')
    {
        $connection = Yii::$app->getDb();
        $count = $connection->createCommand("
            select count(*)
            from archive_cc_code
            where archive like :archive
              and cc_code like :ccCode
        ", [':ccCode' => '%' . $ccCode . '%', ':archive' => $archive . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'db' => $connection,
            'sql' => "
                select archive,
                       cc_code as ccCode
                from archive_cc_code
                where archive like :archive
                  and cc_code like :ccCode
            ",
            'params' => [':ccCode' => '%' . $ccCode . '%', ':archive' => $archive . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['archive' => SORT_ASC],
                'attributes' => [
                    'archive',
                    'ccCode',
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('archive-cc-code', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
