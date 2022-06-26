<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Call;
use app\models\Customer;
use app\models\History;
use Yii;
use yii\helpers\Html;

class HistoryListHelper
{
    private const displayClassMap = [
        History::EVENT_CREATED_TASK => ItemCommonTaskChange::class,
        History::EVENT_COMPLETED_TASK => ItemCommonTaskChange::class,
        History::EVENT_UPDATED_TASK => ItemCommonTaskChange::class,
        History::EVENT_INCOMING_SMS => ItemCommonSms::class,
        History::EVENT_OUTGOING_SMS => ItemCommonSms::class,
        History::EVENT_OUTGOING_FAX => ItemCommonGeneral::class,
        History::EVENT_INCOMING_FAX => ItemCommonGeneral::class,
        History::EVENT_INCOMING_CALL => ItemCommonCall::class,
        History::EVENT_OUTGOING_CALL => ItemCommonCall::class,
        History::EVENT_CUSTOMER_CHANGE_TYPE => ItemCommonGeneral::class,
        History::EVENT_CUSTOMER_CHANGE_QUALITY => ItemCommonGeneral::class,
    ];

    public static function getBodyByModel(History $model)
    {
        switch ($model->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                $task = $model->task;
                return "$model->eventText: " . ($task->title ?? '');
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return $model->sms->message ? $model->sms->message : '';
            case History::EVENT_OUTGOING_FAX:
            case History::EVENT_INCOMING_FAX:
                $fax = $model->fax;
                return $model->eventText . ' - ' .
                    (isset($fax->document) ? Html::a(
                        Yii::t('app', 'view document'),
                        $fax->document->getViewUrl(),
                        [
                            'target' => '_blank',
                            'data-pjax' => 0
                        ]
                    ) : '');
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return "$model->eventText " .
                    (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return "$model->eventText " .
                    (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                /** @var Call $call */
                $call = $model->call;
                return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
            default:
                return $model->eventText;
        }
    }

    public static function getDisplayHelper($model): ItemInterface
    {
        $helperClass = array_key_exists($model->event, self::displayClassMap) ? self::displayClassMap[$model->event] : ItemCommonDefault::class;
        return new $helperClass($model);
    }

}