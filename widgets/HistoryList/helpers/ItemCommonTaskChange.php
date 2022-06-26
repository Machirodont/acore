<?php

namespace app\widgets\HistoryList\helpers;

class ItemCommonTaskChange extends ItemCommonGeneral
{
    public function getParams()
    {
        $params = parent::getParams();

        $task = $this->model->task;
        $params = array_merge($params, [
            'iconClass' => 'fa-check-square bg-yellow',
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : '',
            'footerDatetime' => $this->model->ins_ts,
        ]);

        return $params;
    }
}