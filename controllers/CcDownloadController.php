<?php

namespace app\controllers;

use app\models\CcData;
use app\models\CcDownload;
use app\models\CcDownloadSearch;
use app\models\CcStorage;
use Yii;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CcDownloadController extends Controller
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
        $model = [];
        $model['pending_jobs'] = CcData::find()
            ->leftJoin(CcDownload::tableName(), 'cc_data.id = cc_download.id_cc_data')
            ->orWhere(['cc_download.id' => null])
            ->orWhere(['<>','cc_download.status', CcDownload::STATUS_FINISHED])
            ->count();
        $model['finished_jobs'] = CcDownload::find()
            ->where(['status' => CcDownload::STATUS_FINISHED])
            ->count();
        $model['finished_download_size'] = CcDownload::find()
            ->select(['IFNULL(SUM(size), 0) AS size'])
            ->where(['status' => CcDownload::STATUS_FINISHED])
            ->scalar();
        $model['finished_storage_size'] = CcDownload::find()
            ->select(['IFNULL(SUM(cc_storage.size), 0) AS size'])
            ->leftJoin(CcStorage::tableName(), 'cc_download.id_storage = cc_storage.id')
            ->where(['status' => CcDownload::STATUS_FINISHED])
            ->scalar();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionTask(): string
    {
        $searchModel = new CcDownloadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('task', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionStorage($driveName = ''): string
    {
        $count = Yii::$app->db->createCommand("
            select count(*) over()
            from cc_download cd
                     left join cc_storage cs on cs.id = cd.id_storage
                     left join drive d on cs.id_drive = d.id
            where status = 2
              and d.name like :driveName
            group by d.name
        ", [':driveName' => '%' . $driveName . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => "
                select d.name as driveName,
                       count(*) as finishedStorageJobs,
                       sum(cs.size) as finishedStorageSize
                from cc_download cd
                         left join cc_storage cs on cs.id = cd.id_storage
                         left join drive d on cs.id_drive = d.id
                where status = 2
                  and d.name like :driveName
                group by d.name
            ",
            'params' => [':driveName' => '%' . $driveName . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['driveName' => SORT_ASC],
                'attributes' => [
                    'driveName',
                    'finishedStorageJobs',
                    'finishedStorageSize',
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

    public function actionDailyProgress($date = ''): string
    {
        $count = Yii::$app->db->createCommand("
            select count(*) over()
            from cc_download
            where status = 2
              and date(convert_tz(from_unixtime(finished_at), @@global.time_zone, '+8:00')) like :date
            group by date(convert_tz(from_unixtime(finished_at), @@global.time_zone, '+8:00'))
        ", [':date' => $date . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => "
                select date(convert_tz(from_unixtime(finished_at), @@global.time_zone, '+8:00')) as date0,
                       count(*) as finishedJobs,
                       sum(size) as finishedDownloadSize,
                       sum(size) / max(if(date(convert_tz(from_unixtime(finished_at), @@global.time_zone, '+8:00')) = date(convert_tz(curtime(), @@global.time_zone, '+8:00')), timestampdiff(second, date(convert_tz(curtime(), @@global.time_zone, '+8:00')), convert_tz(curtime(), @@global.time_zone, '+8:00')), 24 * 3600)) as averageDownloadSpeed
                from cc_download
                where status = 2
                  and date(convert_tz(from_unixtime(finished_at), @@global.time_zone, '+8:00')) like :date
                group by date(convert_tz(from_unixtime(finished_at), @@global.time_zone, '+8:00'))
            ",
            'params' => [':date' => $date . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['date0' => SORT_DESC],
                'attributes' => [
                    'date0',
                    'finishedJobs',
                    'finishedDownloadSize',
                    'averageDownloadSpeed',
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('daily-progress', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionYearMonthProgress($yearMonth = ''): string
    {
        $count = Yii::$app->db->createCommand("
            select count(distinct (id_year_month))
            from cc_data
                     left join `year_month` ym on ym.id = cc_data.id_year_month
            where concat(year, '-', month) like :yearMonth
        ", [':yearMonth' => $yearMonth . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => "
                select concat(year, '-', month) as yearMonth,
                       sum(if(cd.id is null, 1, 0)) as pendingJobs,
                       sum(if(cd.status = 2, 1, 0)) as finishedJobs,
                       sum(if(cd.status = 2, cd.size, 0)) as finishedDownloadSize
                from cc_data c
                            left join cc_download cd on cd.id_cc_data = c.id
                         left join `year_month` ym on ym.id = c.id_year_month
                  where concat(ym.year, '-', ym.month) like :yearMonth
                group by ym.id
            ",
            'params' => [':yearMonth' => $yearMonth . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['yearMonth' => SORT_ASC],
                'attributes' => [
                    'yearMonth',
                    'pendingJobs',
                    'finishedJobs',
                    'finishedDownloadSize',
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('year-month-progress', [
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($id): ?CcDownload
    {
        if (($model = CcDownload::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('你请求的页面不存在。');
    }
}
