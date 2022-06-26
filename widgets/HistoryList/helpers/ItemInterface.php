<?php

namespace app\widgets\HistoryList\helpers;

interface ItemInterface
{

    public function __construct($model);

    public function getView();

    public function getParams();
}