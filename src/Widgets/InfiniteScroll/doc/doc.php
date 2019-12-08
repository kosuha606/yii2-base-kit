<?php

use kosuha606\Yii2BaseKit\Widgets\HtmlMassWidget\HtmlMassWidget;use kosuha606\Yii2BaseKit\Widgets\InfiniteScroll\InfiniteScroll;
use kosuha606\Yii2BaseKit\Widgets\InListValuesWidget\InListValuesWidget;

$model = [
    'id' => 1,
    'name' => 'test',
];
$selectedValues = [2];
$fields = [
    [
        'title' => 'США предупредили Москву, что готовы снова нанести удар по Сирии',
        'description' => 'Пострадало трое детей, один ребенок незначительно - "буквально царапины", один погиб и еще один находится в больнице. По данным местных СМИ,'
    ],
    [
        'title' => 'В Москве задержали Алексея Навального',
        'description' => 'Видного оппозиционера взяли около 13 часов у подъезда его дома. "Сейчас он находится в ОВД Даниловский.'
    ],
    [
        'title' => 'США предупредили Москву, что готовы снова нанести удар по Сирии',
        'description' => 'Пострадало трое детей, один ребенок незначительно - "буквально царапины", один погиб и еще один находится в больнице. По данным местных СМИ,'
    ],
    [
        'title' => 'В Москве задержали Алексея Навального',
        'description' => 'Видного оппозиционера взяли около 13 часов у подъезда его дома. "Сейчас он находится в ОВД Даниловский.'
    ],
    [
        'title' => 'США предупредили Москву, что готовы снова нанести удар по Сирии',
        'description' => 'Пострадало трое детей, один ребенок незначительно - "буквально царапины", один погиб и еще один находится в больнице. По данным местных СМИ,'
    ],
    [
        'title' => 'В Москве задержали Алексея Навального',
        'description' => 'Видного оппозиционера взяли около 13 часов у подъезда его дома. "Сейчас он находится в ОВД Даниловский.'
    ],
];
?>
<style>
    .article-items {
        border: solid 1px #ccc;
        padding: 20px;
        text-align: center;
    }
    .article-item {
        text-align: left;
        display: inline-block;
        width: 48%;
        min-height: 300px;
        vertical-align: top;
        padding: 15px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        border: solid 1px #ccc;
        margin-bottom: 10px;
        margin-right: 10px;
    }
</style>
<h1>InfiniteScroll</h1>
<p>
    Виджет для вывода информации бесконечным списком
</p>
<div class="article-items">
<?php InfiniteScroll::begin([
    'allData' => $fields,
    'viewCount' => 4,
]); ?>
    <div class="article-item">
        <h4><%= title %></h4>
        <p><%= description %></p>
    </div>
<?php InfiniteScroll::end(); ?>
</div>

<h2>Базовое использование</h2>
<strong>В PHP</strong>
<pre class="prettyprint">
    <?php HtmlMassWidget::begin(); ?>
[?php
    $fields = [
        [
            'title' => 'США предупредили Москву...',
            'description' => 'По данным местных СМИ...'
        ],
    ];
    InfiniteScroll::begin([
        'allData' => $fields,
        'viewCount' => 4,
    ]); ?]
    <!-- Здесь шаблон для элемента списка -->
    <div class="article-item">
        <h4><%= title %></h4>
        <p><%= description %></p>
    </div>
    [?php InfiniteScroll::end(); ?]
    <?php HtmlMassWidget::end(); ?>
</pre>

<h2>
    Доступные параметры виджета
</h2>

<table class="info-table" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
        <th>Параметр</th>
        <th>Тип</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>$allData</td>
        <td>array</td>
        <td>
            Массив всех данных для ввывода.
            Вместо этого параметра можно запрашивать данные
            с помощью Ajax. Для этого нужно указать параметр
            $synchronizationUrl
        </td>
    </tr>
    <tr>
        <td>$viewCount</td>
        <td>int</td>
        <td>
            Количество записей для отображения.
            Если установлено 4, то при каждом нажатии
            кнопки Еще будет выводится еще по 4 записи
        </td>
    </tr>
    <tr>
        <td>$synchronizationUrl</td>
        <td>string</td>
        <td>
            URL синхронизации с сервером. Необходим для
            запроса элементов от сервера, вместо этого параметра
            можно явно передать данные виджету в параметре allData
        </td>
    </tr>
    <tr>
        <td>$templates</td>
        <td>array</td>
        <td>
            Html шаблоны, которыми манипулирует виджет
        </td>
    </tr>
    </tbody>
</table>
