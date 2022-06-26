<?php

namespace app\services;

use app\widgets\Export\Export;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Request;

class RequestHandlingService
{
    /**
     * @param Request $request
     * @param string $exportType
     * @param string $exportRoute
     * @return string
     */
    public static function getLinkExport(
        Request $request,
        string  $exportType,
        string  $exportRoute
    )
    {
        $params = $request->getQueryParams();
        $params = ArrayHelper::merge([
            'exportType' => $exportType
        ], $params);
        $params[0] = $exportRoute;

        return Url::to($params);
    }
}