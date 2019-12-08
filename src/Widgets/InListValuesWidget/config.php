<?php

use kosuha606\Yii2BaseKit\Widgets\InListValuesWidget\InListValuesWidgetAsset;

return [
    'useContent' => true,
    'sortBy' => false,
    'assets' => [
        InListValuesWidgetAsset::class
    ],
    'jsRepresentation' => __DIR__ . '/InListValuesWidget.js',
    'templates' => [
        'listItemWrapper' => "<ul class='list-items'><%= items %></ul>",
        'listItem' => "<li data-position='<%= position %>'><a href='#'><%= item.name %></a> <%= delTemplate %></li>",
        'modalHeader' => "<h4><%= widget.labels.modal_header %></h4>",
        'addButton' => "<button class='inlist_modal_container' data-widget-id='<%= modalWidgetId %>'><%= widget.labels.add %></button>",
        'deleteButton' => "<button class='delete-button' data-widget-id=''<%= widget.id %>'><%= widget.labels.delete %></button>",
        'saveButton' => "<button class='save-button' data-widget-id='<%= widget.id %>'><%= widget.labels.save %></button>",
    ],
    'labels' => [
        'add' => 'Добавить',
        'save' => 'Сохранить',
        'delete' => 'Удалить',
        'modal_header' => 'Добавить элемент',
    ],
];