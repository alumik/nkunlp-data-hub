<?php

namespace app\controllers;

use app\models\CommonCrawlDataSearch;
use Yii;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class DataDownloadController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new CommonCrawlDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResetOverdueJobs()
    {
        $connection = Yii::$app->get('dbCommonCrawl');
        $count = $connection->createCommand("
            update data
            set download_state = 0,
                started_at=null
            where time_to_sec(timediff(convert_tz(curtime(), @@global.time_zone, '+8:00'), started_at)) > 3600 * 24
              and download_state = 1
        ")->execute();
        Yii::$app->session->setFlash('success', '成功清理 ' . $count . ' 条逾期下载任务。');
        return $this->redirect('index');
    }

    public function actionState()
    {
        $connection = Yii::$app->get('dbCommonCrawl');
        $result = $connection->createCommand("
            select download_state as downloadState,
                   count(*) as finishedJobs,
                   format_bytes(sum(size)) as traffic
            from data
            group by download_state
            order by downloadState
        ")->queryAll();
        $dataProvider = new ArrayDataProvider(['allModels' => $result]);
        return $this->render('state', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDaily($date = '')
    {
        $connection = Yii::$app->get('dbCommonCrawl');
        $count = $connection->createCommand("
            select count(*) over()
            from data
            where archive != '2021-02/03'
              and download_state = 2
              and date(finished_at) like :date
            group by date(finished_at)
        ", [':date' => $date . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'db' => $connection,
            'sql' => "
                select date(finished_at) as date0,
                       count(*) as finishedJobs,
                       format_bytes(sum(size)) as traffic,
                       concat(format_bytes(sum(size) / max(if(date(finished_at) = date(convert_tz(curtime(), @@global.time_zone, '+8:00')), timestampdiff(second, date(convert_tz(curtime(), @@global.time_zone, '+8:00')), convert_tz(curtime(), @@global.time_zone, '+8:00')), 24 * 3600))), '/s') as avgSpeed
                from data
                where archive != '2021-02/03'
                  and download_state = 2
                  and date(finished_at) like :date
                group by date(finished_at)
            ",
            'params' => [':date' => $date . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['date0' => SORT_DESC],
                'attributes' => [
                    'date0',
                    'finishedJobs',
                    'traffic' => [
                        'asc' => ['sum(size)' => SORT_ASC],
                        'desc' => ['sum(size)' => SORT_DESC],
                    ]
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('daily', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWorker($worker = '')
    {
        $connection = Yii::$app->get('dbCommonCrawl');
        $count = $connection->createCommand("
            select count(*) over()
            from data
                     left join worker on data.id_worker = worker.id
            where download_state = 2
              and worker.name like :worker
            group by id_worker
        ", [':worker' => '%' . $worker . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'db' => $connection,
            'sql' => "
                select name,
                       count(*) as finishedJobs,
                       format_bytes(sum(size)) as traffic
                from data
                         left join worker on data.id_worker = worker.id
                where download_state = 2
                  and worker.name like :worker
                group by id_worker
            ",
            'params' => [':worker' => '%' . $worker . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
                'attributes' => [
                    'name',
                    'finishedJobs',
                    'traffic' => [
                        'asc' => ['sum(size)' => SORT_ASC],
                        'desc' => ['sum(size)' => SORT_DESC],
                    ]
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('worker', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArchive($archive = '')
    {
        $connection = Yii::$app->get('dbCommonCrawl');
        $count = $connection->createCommand("
            select count(distinct(archive))
            from data
            where archive like :archive
        ", [':archive' => $archive . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'db' => $connection,
            'sql' => "
                select archive,
                       count(*) as finishedJobs,
                       format_bytes(sum(size)) as traffic
                from data
                where archive like :archive
                group by archive
            ",
            'params' => [':archive' => $archive . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['archive' => SORT_ASC],
                'attributes' => [
                    'archive',
                    'finishedJobs',
                    'traffic' => [
                        'asc' => ['sum(size)' => SORT_ASC],
                        'desc' => ['sum(size)' => SORT_DESC],
                    ]
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('archive', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
