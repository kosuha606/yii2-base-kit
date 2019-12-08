<?php

/** @var $id */

use kosuha606\Yii2BaseKit\Services\StaticViewService\StaticViewService;
use kosuha606\Yii2BaseKit\Widgets\JsTreeWidget\JsTreeWidget;

/** @var $dataUrl */
/** @var $dataJson */
/** @var $widgetName */
/** @var $initialDataToServer */
/** @var $labels */
/** @var $options */
/** @var $plugins */
/** @var $jsOnSelectExpression */
/** @var JsTreeWidget $widget */

$id = "jstree-$id";
$searchId = "jstree-search-$id";
$pluginsKeys = array_keys($plugins);
$arrayService = $widget->arrayHelperService;
$staticViewService = $widget->staticViewService;
$staticViewService->setScenario(StaticViewService::SCENARIO_ONLY_OBJECTS_IN_PARAMS);
$this->registerJs(
    $staticViewService->renderFile(__DIR__.'/pluginInit.js', [
        'id' => "[data-jstree-widget=$id]",
        'searchId' => "#$searchId",
        'dataUrl' => $dataUrl,
        'dataJson' => $dataJson,
        'options' => $options,
        'jsOnSelectExpression' => $jsOnSelectExpression,
        'plugins' => $arrayService->toJson($pluginsKeys),
        'labels' => $labels,
        'initialDataToServer' => $arrayService->toJson($initialDataToServer),
        'widgetName' => $widgetName,
    ], '__')
);
?>
<?php if (in_array('search', $pluginsKeys)) { ?>
<input id="jstree-search-<?= $id ?>" placeholder="<?= $arrayService->getValue($labels, 'search', 'Найти') ?>" type="text" class="<?= $arrayService->getValue($plugins['search'], 'class', '') ?>">
<?php } ?>
<div data-jstree-widget="<?= $id ?>" data-url="<?= $dataUrl ?>"></div>
<?php
$staticViewService->setScenario(StaticViewService::SCENARIO_ALL_DATA_IN_PARAMS);