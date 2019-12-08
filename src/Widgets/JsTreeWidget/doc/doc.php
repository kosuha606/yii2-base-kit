<?php

echo '';

use kosuha606\Yii2BaseKit\Widgets\JsTreeWidget\JsTreeWidget;

?>
<h1>JsTreeWidget</h1>
<p><a target="_blank" href="https://www.jstree.com/">jQuery plugin https://www.jstree.com/</a></p>

<div>
    <table>
        <tr>
            <td>
                <button onclick="JsTreeWidget.build({disable: [5,2,3,4,6,7]})" class="btn btn-default">Построить дерево</button>
                <div>&nbsp;</div>
            </td>
            <td>
                <button onclick="var res = JsTreeWidget.oneSelectedNode(); if (res) {$('#change-result').html(res)} else {$('#change-result').html('Не выбрано')}"
                        class="btn btn-default">Получить выбранный узел
                </button>
                <div id="change-result">Не выбрано</div>
            </td>
        </tr>
    </table>

</div>
<?php
echo JsTreeWidget::widget([
    'dataUrl' => '/api/v1/json/petService/allHierarchy',
    'initialDataToServer' => ['disable' => ['5', '2']]
]);
?>
<h2>Исходный код</h2>
<p>
    Исходный код - <a href="https://github.com/kosuhin/Yii2BaseKit/tree/master/Widgets/JsTreeWidget" target="_blank">JsTreeBuilder</a>
</p>

<h2>Базовое использование</h2>
<strong>В PHP</strong>
<pre class="prettyprint">
echo JsTreeWidget::widget([
    'dataUrl' => '/api/v1/json/petService/allHierarchy',
    'initialDataToServer' => ['disable' => ['5', '2']]
]);
</pre>
<strong>В JS</strong>

<pre class="prettyprint">
JsTreeWidget.build({disable: [1,2,3]}); // - Перестраивает дерево и передает серверу указание запретить 1,2,3
JsTreeWidget.oneSelectedNode(); // - Получение одного выбранного узла
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
        <td>dataUrl</td>
        <td>string</td>
        <td>URL адрес на который будут уходить запросы при попытках jsTree получить данные для дерева</td>
    </tr>
    <tr>
        <td>jsWidgetName</td>
        <td>string</td>
        <td>Строка, которая будет использована виджетом в качестве имени объекта, который будет
            отвечать за представление виджета со стороны JS.
            Для примера, если передать в jsWidgetName слово MyJsTree,
            то в JS вы получите глобальный объект MyJsTree,
            который может MyJsTree.build(params) - перестроить дерево с
            передачей параметров на сервер (переменная params);
            MyJsTree.oneSelectedNode() - получить выбранный узел
        </td>
    </tr>
    <tr>
        <td>initialDataToServer</td>
        <td>array</td>
        <td>
            Здесь можно передать массив данных, которые отправятся
            серверу при первой загрузке виджета
        </td>
    </tr>
    <tr>
        <td>labels</td>
        <td>array</td>
        <td>
            Все статические строки, использованные в виджете
        </td>
    </tr>
    <tr>
        <td>options</td>
        <td>array</td>
        <td>
            Опции jquery плагина jsTree
        </td>
    </tr>
    <tr>
        <td>plugins</td>
        <td>array</td>
        <td>
            Дополнительные плагины jsTree
        </td>
    </tr>
    </tbody>
</table>