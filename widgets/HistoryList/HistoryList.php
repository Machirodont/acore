<?php

namespace app\widgets\HistoryList;

use app\models\search\HistorySearch;
use app\widgets\Export\Export;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

class HistoryList extends Widget
{
    /**
     * @var string
     */
    public $linkExport;

    /**
     * @var HistorySearch
     */
    public $modelSearch;

    /**
     * @var ActiveDataProvider
     */
    public $dataProvider;


    /**
     * @return string
     */
    public function run()
    {
        return $this->render('main', [
            'model' => $this->modelSearch,
            'linkExport' => $this->linkExport,
            'dataProvider' => $this->dataProvider
        ]);
    }


}
