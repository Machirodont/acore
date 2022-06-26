<?php

use app\models\search\HistorySearch;
use app\widgets\HistoryList\helpers\HistoryListHelper;

/** @var $model HistorySearch */


$helper = HistoryListHelper::getDisplayHelper($model);

echo $this->render($helper->getView(), $helper->getParams());