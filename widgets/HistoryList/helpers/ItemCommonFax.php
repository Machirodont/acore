<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Sms;
use Yii;
use yii\helpers\Html;

class ItemCommonFax extends ItemCommonGeneral
{
    public function getParams()
    {
        $params = parent::getParams();

        $fax = $this->model->fax;
        $params += [
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ];

        return $params;
    }
}