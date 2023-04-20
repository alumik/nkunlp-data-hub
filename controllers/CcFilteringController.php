<?php

namespace app\controllers;

use app\models\CcChineseExtraction;
use app\models\CcStorage;
use Yii;
use app\models\CcFiltering;
use app\models\CcFilteringSearch;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CcFilteringController extends Controller
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
        $model['pending_jobs'] = CcChineseExtraction::find()
            ->leftJoin(CcFiltering::tableName(), 'cc_chinese_extraction.id = cc_filtering.id_cc_chinese_extraction')
            ->orWhere(['cc_filtering.id' => null])
            ->orWhere(['!=', 'cc_filtering.status', CcFiltering::STATUS_FINISHED])
            ->count();
        $model['pending_size'] = CcChineseExtraction::find()
            ->select(['ifnull(sum(cc_storage.size), 0) as size'])
            ->leftJoin(CcFiltering::tableName(), 'cc_chinese_extraction.id = cc_filtering.id_cc_chinese_extraction')
            ->leftJoin(CcStorage::tableName(), 'cc_chinese_extraction.id_storage = cc_storage.id')
            ->orWhere(['cc_filtering.id' => null])
            ->orWhere(['<>','cc_filtering.status', CcFiltering::STATUS_FINISHED])
            ->scalar();
        $model['finished_jobs'] = CcFiltering::find()
            ->where(['status' => CcFiltering::STATUS_FINISHED])
            ->count();
        $model['finished_in_size'] = CcChineseExtraction::find()
            ->select(['ifnull(sum(cc_storage.size), 0) as size'])
            ->leftJoin(CcFiltering::tableName(), 'cc_chinese_extraction.id = cc_filtering.id_cc_chinese_extraction')
            ->leftJoin(CcStorage::tableName(), 'cc_chinese_extraction.id_storage = cc_storage.id')
            ->orWhere(['cc_filtering.status' => CcFiltering::STATUS_FINISHED])
            ->scalar();
        $model['finished_out_size'] = CcFiltering::find()
            ->select(['ifnull(sum(cc_storage.size), 0) as size'])
            ->leftJoin(CcStorage::tableName(), 'cc_filtering.id_storage = cc_storage.id')
            ->where(['status' => CcFiltering::STATUS_FINISHED])
            ->scalar();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionTask(): string
    {
        $searchModel = new CcFilteringSearch();
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
            from cc_filtering cf
                     left join cc_storage cs on cs.id = cf.id_storage
                     left join drive d on cs.id_drive = d.id
            where status = 2
              and d.name like :driveName
            group by d.name
        ", [':driveName' => '%' . $driveName . '%'])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => "
                select d.name as driveName,
                       count(*) as finishedJobs,
                       sum(cs.size) as finishedOutSize
                from cc_filtering cf
                         left join cc_storage cs on cs.id = cf.id_storage
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
                    'finishedJobs',
                    'finishedOutSize',
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

    protected function findModel($id): ?CcFiltering
    {
        if (($model = CcFiltering::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('你请求的页面不存在。');
    }
}
