<?php

use kosuha606\Yii2BaseKit\Widgets\InListValuesWidget\InListValuesWidget;

$model = [
    'id' => 1,
    'name' => 'test',
];
$selectedValues = [2];
$fields = [
    [
        'position' => '4',
        'name' => 'test1234'
    ],
    [
        'position' => '1',
        'name' => 'test1'
    ],
    [
        'position' => '2',
        'name' => 'test12'
    ],
    [
        'position' => '3',
        'name' => 'test123'
    ],
];
?>
<h1>InListValuesWidget</h1>
<p>
    Виджет создания TODO списков
</p>
<?php InListValuesWidget::begin([
    'model' => $model,
    'attribute' => 'dependent',
    'selectedValues' => $selectedValues,
    'allValues' => $fields,
    'sortBy' => 'position'
]); ?>
<label>
    Имя
    <input type="text" name="name">
</label>
<label>
    Позиция
    <input type="text" name="position">
</label>
<?php InListValuesWidget::end(); ?>
<h2>Исходный код</h2>
<p>
    Исходный код - <a href="https://github.com/kosuhin/Yii2BaseKit/tree/master/Widgets/InListValuesWidget"
                      target="_blank">InListValuesWidget</a>
</p>

<h2>Базовое использование</h2>
<strong>В PHP</strong>
<pre class="prettyprint">
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
    </tbody>
</table>
