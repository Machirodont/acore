<?php

namespace app\controllers;

use app\models\search\HistorySearch;
use app\widgets\Export\Export;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $modelSearch = new HistorySearch();

        return $this->render('index', [
            'modelSearch' => $modelSearch,
            'dataProvider' => $modelSearch->search(Yii::$app->request->queryParams),
            'linkExport' => $this->getLinkExport(),
        ]);
    }


    /**
     * @param string $exportType
     * @return string
     */
    public function actionExport($exportType)
    {
        $modelSearch = new HistorySearch();

        return $this->render('export', [
            'dataProvider' => $modelSearch->search(Yii::$app->request->queryParams),
            'model' => $modelSearch,
            'exportType' => $exportType,
        ]);
    }

    /**
     * @return string
     */
    private function getLinkExport()
    {
        $params = Yii::$app->getRequest()->getQueryParams();
        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = 'site/export';

        return Url::to($params);
    }
}
