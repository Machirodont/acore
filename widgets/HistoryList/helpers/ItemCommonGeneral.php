<?php

namespace app\widgets\HistoryList\helpers;

use app\models\search\HistorySearch;

class ItemCommonGeneral implements ItemInterface
{
    /**
     * @var HistorySearch
     */
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getView()
    {
        return '_item_common';
    }

    public function getParams()
    {
        $model = $this->model;
        return [
            'user' => $model->user,
            'body' => HistoryListHelper::getBodyByModel($model),
            'iconClass' => 'fa-gear bg-purple-light'
        ];
    }
}