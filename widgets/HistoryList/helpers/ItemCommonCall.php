<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Call;
use app\models\Sms;
use Yii;

class ItemCommonCall extends ItemCommonGeneral
{
    public function getParams()
    {
        $params = parent::getParams();

        /** @var Call $call */
        $call = $this->model->call;
        $answered = $call && $call->status == Call::STATUS_ANSWERED;

        $params += [
            'content' => $call->comment ?? '',
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
        ];

        return $params;
    }
}