<?php

use kosuha606\Yii2BaseKit\Widgets\ConditionFormFieldsWidget\ConditionFormFieldsWidget;
use kosuha606\Yii2BaseKit\Widgets\HtmlMassWidget\HtmlMassWidget;

?>
    <h1>ConditionFormFieldsWidget.php</h1>
    <p>
        Виджет для изменения формы в зависимости от тех или иных условий
    </p>
<h2>Пример</h2>
    <label for="choose">Выберите тип данных</label>
    <select name="choose" id="choose">
        <option value="1">Текстовый</option>
        <option value="2">Числовой</option>
        <option value="3">Файл</option>
    </select>
<?php ConditionFormFieldsWidget::begin([
    'condition' => htmlspecialchars('[name="choose"]'),
    'conditionValue' => 1,
]); ?>
    <h3>Текстовое значение</h3>
    <label for="">
        Введите значение <input type="text">
    </label> <br>
    <label for="">
        Недопустимые символы <input type="text">
    </label>
<?php ConditionFormFieldsWidget::end(); ?>
<?php ConditionFormFieldsWidget::begin([
    'condition' => htmlspecialchars('[name="choose"]'),
    'conditionValue' => 2,
]); ?>
    <h3>Числовое значение</h3>
    <label for="">
        Максимум <input type="number">
    </label> <br>
    <label for="">
        Минимум <input type="number">
    </label>
<?php ConditionFormFieldsWidget::end(); ?>
<?php ConditionFormFieldsWidget::begin([
    'condition' => htmlspecialchars('[name="choose"]'),
    'conditionValue' => 3,
]); ?>
    <h3>Файл</h3>
    <label for="">
        Тип файла
        <select name="" id="">
            <option value="">png</option>
            <option value="">jpg</option>
        </select>
    </label> <br>
    <label for="">
        Файл
        <input type="file">
    </label>
<?php ConditionFormFieldsWidget::end(); ?>
<h2>Базовое использование</h2>
<h3>В PHP</h3>
<pre class="prettyprint">
    <?php HtmlMassWidget::begin(); ?>
<label for="choose">Выберите тип данных</label>
    <select name="choose" id="choose">
        <option value="1">Текстовый</option>
        <option value="2">Числовой</option>
        <option value="3">Файл</option>
    </select>
    <?php HtmlMassWidget::begin(['action' => 'decode']); ?>
&#x3C; ?php ConditionFormFieldsWidget::begin([
        'condition' => '[name="choose"]',
        'conditionValue' => 1,
    ]); ? &#x3E;
    <?php HtmlMassWidget::end(); ?>
<h3>Текстовое значение</h3>
    <label for="">
        Введите значение <input type="text">
    </label> <br>
    <label for="">
        Недопустимые символы <input type="text">
    </label>
    <?php HtmlMassWidget::begin(['action' => 'decode']); ?>
&#x3C; ?php ConditionFormFieldsWidget::end(); ? &#x3E;
    &#x3C; ?php ConditionFormFieldsWidget::begin([
        'condition' => '[name="choose"]',
        'conditionValue' => 2,
    ]); ? &#x3E;
    <?php HtmlMassWidget::end(); ?>
<h3>Числовое значение</h3>
    <label for="">
        Максимум <input type="number">
    </label> <br>
    <label for="">
        Минимум <input type="number">
    </label>
    <?php HtmlMassWidget::begin(['action' => 'decode']); ?>
&#x3C; ?php ConditionFormFieldsWidget::end(); ? &#x3E;
    &#x3C; ?php ConditionFormFieldsWidget::begin([
        'condition' => '[name="choose"]',
        'conditionValue' => 3,
    ]); ? &#x3E;
    <?php HtmlMassWidget::end(); ?>
<h3>Файл</h3>
    <label for="">
        Тип файла
        <select name="" id="">
            <option value="">png</option>
            <option value="">jpg</option>
        </select>
    </label> <br>
    <label for="">
        Файл
        <input type="file">
    </label>
    <?php HtmlMassWidget::begin(['action' => 'decode']); ?>
&#x3C; ?php ConditionFormFieldsWidget::end(); ? &#x3E;
    <?php HtmlMassWidget::end(); ?>
    <?php HtmlMassWidget::end(); ?>
</pre>

<h2>
    Доступные параметры виджета
</h2>
<p>
    Данный виджет поддерживает ::begin() и ::end() - эти методы можно использовать вместо
    параметра $formHtml.
</p>
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
        <td>$condition</td>
        <td>string</td>
        <td>Здесь указывается имя поля ввода изменение которого будет остлеживаться и содержимое виджета будет показываться</td>
    </tr>
    <tr>
        <td>$conditionValue</td>
        <td>string</td>
        <td>Здесь указывается значение поля из $condition, если значение $condition равно $conditionValue то $formHtml или содержимое между begin и end будет выведено</td>
    </tr>
    <tr>
        <td>$formHtml</td>
        <td>string</td>
        <td>Содержимое, которое необходимо показать при выполнении условия</td>
    </tr>
    </tbody>
</table>