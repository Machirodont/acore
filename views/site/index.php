<?php
/**
 * @var string $linkExport
 * @var HistorySearch $modelSearch
 * @var ActiveDataProvider $dataProvider
 */

use app\models\search\HistorySearch;
use app\widgets\HistoryList\HistoryList;
use yii\data\ActiveDataProvider;

$this->title = 'Americor Test';
?>

<div class="site-index">
    <?= HistoryList::widget([
        'modelSearch' => $modelSearch,
        'dataProvider' => $dataProvider,
        'linkExport' => $linkExport,
    ]) ?>
</div>
