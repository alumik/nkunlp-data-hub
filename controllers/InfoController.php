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
        return $this->render('progress', [
            'progress' => $progress,
        ]);
    }

    public function actionArchiveCcCode($ccCode = '', $archive = '')
    {
        $connection = Yii::$app->get('dbCommonCrawl');
        $count = $connection->createCommand("
            select count(distinct(archive))
            from data
            where archive like :archive
              and substring(uri, 12, 15) like :ccCode
        ", [':ccCode' => '%' . $ccCode . '%', ':archive' => $archive . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'db' => $connection,
            'sql' => "
                select distinct(archive) as archive0,
                       substring(uri, 12, 15) as ccCode
                from data
                where archive like :archive
                  and substring(uri, 12, 15) like :ccCode
            ",
            'params' => [':ccCode' => '%' . $ccCode . '%', ':archive' => $archive . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['archive0' => SORT_ASC],
                'attributes' => [
                    'archive0',
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
