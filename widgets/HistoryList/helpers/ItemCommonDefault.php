<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Sms;
use Yii;
use yii\helpers\Html;

class ItemCommonDefault extends ItemCommonGeneral
{
    public function getParams()
    {
        $params = parent::getParams();

        $params = array_merge($params, [
            'bodyDatetime' => $this->model->ins_ts,
        ]);

        return $params;
    }
}