<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

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
                select t0.deviceName                              as deviceName,
                       t0.archive                                 as archive,
                       format_bytes(t0.readableSize)              as totalSize,
                       t0.fileCount                               as totalCount,
                       format_bytes(coalesce(t1.readableSize, 0)) as unprocessedSize,
                       coalesce(t1.fileCount, 0)                  as unprocessedCount,
                       format_bytes(coalesce(t2.readableSize, 0)) as processedSize,
                       coalesce(t2.fileCount, 0)                  as processedCount
                from (select device_name as deviceName,
                             archive,
                             sum(size) as readableSize,
                             count(*) as fileCount
                      from storage
                               left join device on storage.id_device = device.id
                      where prefix = 'original'
                            and device_name like :deviceName
                            and archive like :archive
                      group by device_name, archive) t0
                         left join
                     (select device_name as deviceName,
                             sum(size)   as readableSize,
                             count(*)    as fileCount
                      from storage
                               left join device on storage.id_device = device.id
                               left join data d on storage.id = d.id_storage
                      where prefix = 'original'
                        and filter_state != 2
                        and device_name like :deviceName
                        and storage.archive like :archive
                      group by device_name) t1
                     on t0.deviceName = t1.deviceName
                         left join
                     (select device_name as deviceName,
                             sum(size)   as readableSize,
                             count(*)    as fileCount
                      from storage
                               left join device on storage.id_device = device.id
                               left join data d on storage.id = d.id_storage
                      where prefix = 'original'
                        and filter_state = 2
                        and device_name like :deviceName
                        and storage.archive like :archive
                      group by device_name) t2
                     on t0.deviceName = t2.deviceName
            ",
            'params' => [':deviceName' => '%' . $deviceName . '%', ':archive' => $archive . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['deviceName' => SORT_ASC],
                'attributes' => [
                    'deviceName',
                    'archive',
                    'totalCount',
                    'unprocessedCount',
                    'processedCount',
                    'totalSize' => [
                        'asc' => ['t0.readableSize' => SORT_ASC],
                        'desc' => ['t0.readableSize' => SORT_DESC],
                    ],
                    'unprocessedSize' => [
                        'asc' => ['t1.readableSize' => SORT_ASC],
                        'desc' => ['t1.readableSize' => SORT_DESC],
                    ],
                    'processedSize' => [
                        'asc' => ['t2.readableSize' => SORT_ASC],
                        'desc' => ['t2.readableSize' => SORT_DESC],
                    ],
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
