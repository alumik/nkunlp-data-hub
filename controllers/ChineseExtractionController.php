<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ChineseExtractionController extends Controller
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

    public function actionIndex($uri = '', $deviceName = '', $archive = '')
    {
        $connection = Yii::$app->getDb();
        $count = $connection->createCommand("
            select count(*)
            from data
                     left join storage on id_storage = storage.id
                     left join device on storage.id_device = device.id
            where uri like :uri
              and device_name like :deviceName
              and data.archive like :archive
        ", [':uri' => '%' . $uri . '%', ':deviceName' => '%' . $deviceName . '%', ':archive' => $archive . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'db' => $connection,
            'sql' => "
                select data.id as ID,
                       data.uri as URI,
                       device.device_name as deviceName,
                       storage.archive as archive
                from data
                         left join storage on id_storage = storage.id
                         left join device on storage.id_device = device.id
                where uri like :uri
                  and device_name like :deviceName
                  and data.archive like :archive
            ",
            'params' => [':uri' => '%' . $uri . '%', ':deviceName' => '%' . $deviceName . '%', ':archive' => $archive . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['ID' => SORT_ASC],
                'attributes' => [
                    'ID',
                    'URI',
                    'deviceName',
                    'archive',
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionState()
    {
        $connection = Yii::$app->getDb();
        $result = $connection->createCommand("
            select count(*) as finishedJobs,
                   format_bytes(sum(size)) as readableSize
            from storage
            where prefix = 'original'
        ")->queryOne();
        return $this->render('state', [
            'result' => $result,
        ]);
    }

    public function actionStorage($deviceName = '', $archive = '')
    {
        $connection = Yii::$app->getDb();
        $count = $connection->createCommand("
            select count(*) over()
            from storage
                     left join device on storage.id_device = device.id
            where prefix = 'original'
              and device_name like :deviceName
              and archive like :archive
            group by device_name, archive
        ", [':deviceName' => '%' . $deviceName . '%', ':archive' => $archive . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'db' => $connection,
            'sql' => "
                select device_name as deviceName,
                       archive,
                       format_bytes(sum(size)) as readableSize,
                       count(*) as fileCount
                from storage
                         left join device on storage.id_device = device.id
                where prefix = 'original'
                  and device_name like :deviceName
                  and archive like :archive
                group by device_name, archive
            ",
            'params' => [':deviceName' => '%' . $deviceName . '%', ':archive' => $archive . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['deviceName' => SORT_ASC],
                'attributes' => [
                    'deviceName',
                    'archive',
                    'fileCount',
                    'readableSize' => [
                        'asc' => ['sum(size)' => SORT_ASC],
                        'desc' => ['sum(size)' => SORT_DESC],
                    ]
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('storage', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
