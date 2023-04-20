<?php

namespace app\controllers;

use app\models\CcChineseExtraction;
use app\models\CcChineseExtractionSearch;
use app\models\CcDownload;
use app\models\CcStorage;
use Yii;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CcChineseExtractionController extends Controller
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
        $model['pending_jobs'] = CcDownload::find()
            ->leftJoin(CcChineseExtraction::tableName(), 'cc_download.id = cc_chinese_extraction.id_cc_download')
            ->orWhere(['cc_chinese_extraction.id' => null])
            ->orWhere(['<>','cc_chinese_extraction.status', CcChineseExtraction::STATUS_FINISHED])
            ->count();
        $model['pending_size'] = CcDownload::find()
            ->select(['ifnull(sum(cc_storage.size), 0) as size'])
            ->leftJoin(CcChineseExtraction::tableName(), 'cc_download.id = cc_chinese_extraction.id_cc_download')
            ->leftJoin(CcStorage::tableName(), 'cc_download.id_storage = cc_storage.id')
            ->orWhere(['cc_chinese_extraction.id' => null])
            ->orWhere(['<>','cc_chinese_extraction.status', CcChineseExtraction::STATUS_FINISHED])
            ->scalar();
        $model['finished_jobs'] = CcChineseExtraction::find()
            ->where(['status' => CcChineseExtraction::STATUS_FINISHED])
            ->count();
        $model['finished_out_size'] = CcChineseExtraction::find()
            ->select(['sum(size) as size'])
            ->leftJoin(CcStorage::tableName(), 'cc_chinese_extraction.id_storage = cc_storage.id')
            ->where(['status' => CcChineseExtraction::STATUS_FINISHED])
            ->scalar();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionTask(): string
    {
        $searchModel = new CcChineseExtractionSearch();
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
            from cc_chinese_extraction cce
                     left join cc_storage cs on cs.id = cce.id_storage
                     left join drive d on cs.id_drive = d.id
            where status = 2
              and d.name like :driveName
            group by d.name
        ", [':driveName' => '%' . $driveName . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => "
                select d.name as driveName,
                       count(*) as finishedJobs,
                       sum(cs.size) as finishedOutSize,
                       sum(if(cf.id is null or cf.status != 2, 1, 0)) as pendingNextJobs,
                       sum(if(cf.id is null or cf.status != 2, cs.size, 0)) as pendingNextInSize
                from cc_chinese_extraction cce
                         left join cc_storage cs on cs.id = cce.id_storage
                         left join drive d on cs.id_drive = d.id
                         left join cc_filtering cf on cce.id = cf.id_cc_chinese_extraction
                where cce.status = 2
                  and d.name like :driveName
                group by d.name
            ",
            'params' => [':driveName' => '%' . $driveName . '%'],
            'totalCount' => $count,
            'sort' => [
                'defaultOrder' => ['driveName' => SORT_ASC],
                'attributes' => [
                    'driveName',
                    'finishedJobs',
                    'finishedOutSize',
                    'pendingNextJobs',
                    'pendingNextInSize'
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

    protected function findModel($id): ?CcChineseExtraction
    {
        if (($model = CcChineseExtraction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('你请求的页面不存在。');
    }
}
