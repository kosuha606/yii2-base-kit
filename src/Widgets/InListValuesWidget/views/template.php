<?php

use kosuha606\Yii2BaseKit\Services\StaticViewService\StaticViewService;
use kosuha606\Yii2BaseKit\Widgets\InListValuesWidget\InListValuesWidget;
use yii\bootstrap\Modal;

/** @var InListValuesWidget $widget */
/** @var  $modalWidgetId */
/** @var  $content */

$modalWidgetId = 'inlistwidget-modal-' . $id;
?>
<div id="<?= $widget->id ?>">
    <?php
    $widget->staticViewService->setScenario(StaticViewService::SCENARIO_ONLY_OBJECTS_IN_PARAMS);
    $items = '';
    foreach ($widget->allValues as $pos => $value) {
        $items .= $widget->staticViewService->renderContent(
            $widget->templates['listItem'],
            [
                'widget' => $widget,
                'item' => $value,
                'position' => $pos,
                'delTemplate' => $widget->staticViewService->renderContent(
                    $widget->templates['deleteButton'],
                    [
                        'widget' => $widget,
                    ],
                    ['open' => '<%=', 'close' => '%>']
                )
            ],
            ['open' => '<%=', 'close' => '%>']
        );
    }
    echo $widget->staticViewService->renderContent(
        $widget->templates['listItemWrapper'],
        [
            'items' => $items,
        ],
        ['open' => '<%=', 'close' => '%>']
    );
    Modal::begin([
        'options' => [
            'id' => $modalWidgetId,
            'tabindex' => false
        ],
        'header' => $widget->staticViewService->renderContent(
            $widget->templates['modalHeader'],
            ['widget' => $widget],
            ['open' => '<%=', 'close' => '%>']
        ),
        'footer' => $widget->staticViewService->renderContent(
            $widget->templates['saveButton'],
            ['widget' => $widget],
            ['open' => '<%=', 'close' => '%>']
        )
    ]);
    echo $content;
    Modal::end();
    echo $widget->staticViewService->renderContent(
        $widget->templates['addButton'],
        [
            'widget' => $widget,
            'modalWidgetId' => $modalWidgetId,
        ],
        ['open' => '<%=', 'close' => '%>']
    );
    $widget->staticViewService->setScenario(StaticViewService::SCENARIO_ALL_DATA_IN_PARAMS);
    ?>
</div>
