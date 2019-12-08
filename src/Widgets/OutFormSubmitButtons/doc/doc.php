<?php

echo '';

use kosuha606\Yii2BaseKit\Widgets\JsChartWidget\JsChartWidget;
use kosuha606\Yii2BaseKit\Widgets\OutFormSubmitButtons\OutFormSubmitButtons;
use yii\widgets\ActiveForm;

?>
<h1>OutFormSubmitButtons.php</h1>
<p>
    Виджет с помощью которого можно вынести кнопки сабмита формы за пределы формы
</p>

<?php $form = ActiveForm::begin(['id' => 'form']); ?>
<select name="1" id="1">
    <option value="1">Раз</option>
    <option value="2">Два</option>
</select>
<?php ActiveForm::end(); ?>
<div>Контент вне формы</div>
<?php
echo OutFormSubmitButtons::widget([
    'options' => [
        'form_id' => 'form',
        'action_field' => 'submitAction',
        'buttons' => [
            [
                'label' => 'Сохранить проект',
                'name' => 'save_without_data',
                'type' => 'button',
                'class' => 'btn btn-success'
            ],
            [
                'label' => 'Сохранить данные в тестовую БД',
                'name' => 'save_to_test',
                'type' => 'button',
                'class' => 'btn btn-primary'
            ],
            [
                'label' => 'Сохранить данные в основную БД',
                'name' => 'save_to_db',
                'type' => 'button',
                'class' => 'btn btn-primary'
            ],
            [
                'label' => 'Удалить файл',
                'name' => 'delete',
                'type' => 'link',
                'class' => 'btn btn-danger'
            ]
        ]
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

echo OutFormSubmitButtons::widget([
    'options' => [
        'form_id' => 'form',
        'action_field' => 'submitAction',
        'buttons' => [
            [
                'label' => 'Сохранить проект',
                'name' => 'save_without_data',
                'type' => 'button',
                'class' => 'btn btn-success'
            ],
            [
                'label' => 'Сохранить данные в тестовую БД',
                'name' => 'save_to_test',
                'type' => 'button',
                'class' => 'btn btn-primary'
            ],
            [
                'label' => 'Сохранить данные в основную БД',
                'name' => 'save_to_db',
                'type' => 'button',
                'class' => 'btn btn-primary'
            ],
            [
                'label' => 'Удалить файл',
                'name' => 'delete',
                'type' => 'link',
                'class' => 'btn btn-danger'
            ]
        ]
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
    </tbody>
</table>
