<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Sms;
use Yii;

class ItemCommonSms extends ItemCommonGeneral
{
    public function getParams()
    {
        $params = parent::getParams();

        $params += [
            'footer' => $this->model->sms->direction == Sms::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $this->model->sms->direction == Sms::DIRECTION_INCOMING,
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ];

        return $params;
    }
}