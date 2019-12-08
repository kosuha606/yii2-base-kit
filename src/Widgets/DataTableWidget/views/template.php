<?php

use kosuha606\Yii2BaseKit\Services\StaticViewService\StaticViewService;

/** @var StaticViewService $staticViewService */
$staticViewService = Yii::$app->staticViewService;
$i18n = $staticViewService->renderFile(
    __DIR__ . '/i18n/ru_RU.json',
    []
);
$this->registerJs(
    $staticViewService->renderFile(
        __DIR__ . '/pluginInit.js',
        [
            'id' => '#data-table-' . $id,
            'i18n' => $i18n
        ], '__'
    )
);
?>
<table id="data-table-<?= $id ?>">
    <thead>
    <tr>
        <?php foreach ($headers as $header) { ?>
            <th><?= $header ?></th>
        <?php } ?>
    </tr>
    </thead>
</table>
<?php

Yii::$app->staticViewService->setScenario(StaticViewService::SCENARIO_ALL_DATA_IN_PARAMS);