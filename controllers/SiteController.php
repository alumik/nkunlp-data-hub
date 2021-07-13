<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ServerMgmtSearch;

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
        $searchModel = new ServerMgmtSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
