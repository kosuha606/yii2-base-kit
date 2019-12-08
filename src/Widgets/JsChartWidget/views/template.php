<?php

use kosuha606\Yii2BaseKit\Widgets\JsChartWidget\JsChartWidget;

/** @var $height */
/** @var $width */
/** @var $label */
/** @var $data */
/** @var $type */
/** @var $borderWidth */
/** @var $id */
/** @var JsChartWidget $widget */

$colorHelperService = $widget->colorHelperService;
$arrayService = $widget->arrayHelperService;
$id = "myChart-$id";
$staticViewService = $widget->staticViewService;
$labels = [];
$dataset = [
    'label' => $label,
    'borderWidth' => $borderWidth,
];
foreach ($data as $label => $option) {
    $labels[] = $label;
    $dataset['data'][] = $arrayService->getValue($option, 'value', '1');
    $color = $arrayService->getValue($option, 'color', '#ffdae1');
    $dataset['backgroundColor'][] = $colorHelperService->hexToRgba($color, '0.2');
    $dataset['borderColor'][] = $colorHelperService->hexToRgba($color, '1');
}
$this->registerJs($staticViewService->renderFile(__DIR__ . '/pluginInit.js', [
    'id' => "$id",
    'type' => $type,
    'labels' => $arrayService->toJson($labels),
    'dataset' => $arrayService->toJson($dataset),
], '__'));
?>
<div class="chart-container" style="position: relative; height: <?= $width ?>; width: <?= $width ?>">
    <canvas id="<?= $id ?>" width="<?= $width ?>" height="<?= $height ?>"></canvas>
</div>
