<?php

use kosuha606\Yii2BaseKit\Widgets\DataTableWidget\DataTableWidget;
?>
    <h1>DataTableWidget</h1>
    <p>
        <a target="_blank" href="https://datatables.net/">jQuery plugin https://datatables.net/</a>
    </p>
<?php
echo DataTableWidget::widget([
    'headers' => [
        'id',
        'Имя',
        'Тип'
    ]
]);

?>