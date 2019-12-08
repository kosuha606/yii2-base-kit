<?php

use kosuha606\Yii2BaseKit\Widgets\TODOListWidget\TODOListWidget;

?>
<h1>TODOListWidget</h1>
<p>
    Виджет создания TODO списков
</p>
<?php
echo TODOListWidget::widget([
    'values' => $model->getChildrensData(),
    'items' => $fields,
    'title' => 'Подчиненные поля',
    'name' => 'Field[dependent]',
    'model' => $model,
    'form' => $form,
    'addButton' => false,
    'formHTML' => $this->render('@themes/modules/admin/input-fields/add_field_form', [
        'items' => $fields,
    ])
]);
?>
<h2>Исходный код</h2>
<p>
    Исходный код - <a href="https://github.com/kosuhin/Yii2BaseKit/tree/master/Widgets/TODOListWidget" target="_blank">TODOListWidget</a>
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
