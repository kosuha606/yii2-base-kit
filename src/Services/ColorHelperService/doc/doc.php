<?php

echo '';

use kosuha606\Yii2BaseKit\Widgets\JsChartWidget\JsChartWidget;

?>
<h1>ColorHelperService</h1>
<pre class="prettyprint">
    Yii::$app->get('colorHelperService')
</pre>
<p>
    Сервис предназначен для хранения логики обработки цветов
</p>

<h2>Исходный код</h2>
<p>
    Исходный код - <a href="https://github.com/kosuhin/Yii2BaseKit/blob/master/Services/ColorHelperService.php" target="_blank">ColorHelperService</a>
</p>

<h2>
    Описание методов
</h2>

<table class="info-table" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
        <th>Метод</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>hexToRgba</td>
        <td>
            Перевод строки "#ff0000" в формат rgba "rgba(255,0,0,1)"
        </td>
    </tr>
    </tbody>
</table>