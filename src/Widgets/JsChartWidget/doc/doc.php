<?php

echo '';

use kosuha606\Yii2BaseKit\Widgets\JsChartWidget\JsChartWidget;

?>
<h1>JsChartWidget</h1>
<p><a target="_blank" href="http://www.chartjs.org/docs/latest/">jQuery plugin http://www.chartjs.org</a>
</p>

<?php
echo JsChartWidget::widget([
    'label' => 'Навыки разработчика',
    'data' => [
        'PHP' => [
            'value' => '1000',
            'color' => '#af66ff',
        ],
        'JS' => [
            'value' => '400',
            'color' => '#d9e693',
        ],
        'HTML' => [
            'value' => '200',
            'color' => '#93e69d'
        ],
    ]
]);
?>

<h2>Исходный код</h2>
<p>
    Исходный код - <a href="https://github.com/kosuhin/Yii2BaseKit/tree/master/Widgets/JsChartWidget" target="_blank">JsChartWidget</a>
</p>

<h2>Базовое использование</h2>
<strong>В PHP</strong>
<pre class="prettyprint">
echo JsChartWidget::widget([
    'label' => 'Навыки разработчика',
    'data' => [
        'PHP' => [
            'value' => '1000',
            'color' => '#af66ff',
        ],
        'JS' => [
            'value' => '400',
            'color' => '#d9e693',
        ],
        'HTML' => [
            'value' => '200',
            'color' => '#93e69d'
        ],
    ]
]);
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
        <td>height</td>
        <td>string</td>
        <td>
            Строка представляющая ширину диаграммы
        </td>
    </tr>
    <tr>
        <td>width</td>
        <td>string</td>
        <td>
            Строка представляющая высоту диаграммы
        </td>
    </tr>
    <tr>
        <td>type</td>
        <td>string</td>
        <td>
            Тип диаграммы см документацию плагина
        </td>
    </tr>
    <tr>
        <td>label</td>
        <td>string</td>
        <td>
            Заголовок диаграммы
        </td>
    </tr>
    <tr>
        <td>borderWidth</td>
        <td>string</td>
        <td>
            Ширина полей диаграммы
        </td>
    </tr>
    <tr>
        <td>data</td>
        <td>array</td>
        <td>
            Данные по которым будет построена диаграмма.
            Каждый ключ элемента массива data - будет заголовком.
            Каждое значение value - значение точки диаграммы, color - цвет диаграммы
        </td>
    </tr>
    </tbody>
</table>
