<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\web\Controller;

class InfoController extends Controller
{
    public function actionArchiveDevice($deviceName = '', $archive = '')
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
                       archive
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
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('archive-device', [
            'dataProvider' => $dataProvider,
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
