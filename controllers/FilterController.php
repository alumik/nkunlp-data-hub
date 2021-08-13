<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class FilterController extends Controller
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

    public function actionState()
    {
        $connection = Yii::$app->getDb();
        $processed = $connection->createCommand("
            select format_bytes(sum(size)) as processedSize,
                   count(*)                as processedCount
            from storage
            where prefix like 'filtered_clean%';
        ")->queryOne();
        $unprocessed = $connection->createCommand("
            select format_bytes(sum(size)) as unprocessedSize,
                   count(*)                as unprocessedCount
            from storage
                     left join data on storage.id = id_storage
            where prefix = 'original'
              and filter_state != 2;
        ")->queryOne();
        $result = array_merge($unprocessed, $processed);
        return $this->render('state', [
            'result' => $result,
        ]);
    }
}
