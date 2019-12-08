<?php

use yii\bootstrap\Modal;

/** @var $content */
/** @var string $title */
/** @var $id */
?>
<div class="<?= $class ?>">
    <?php
    Modal::begin([
        'options' => [
            'id' => 'kartik-modal' . $id,
            'tabindex' => false
        ],
        'header' => '<h4 style="margin:0; padding:0">' . $title . '</h4>',
        'toggleButton' => [
            'label' => '<i class="glyphicon glyphicon-info-sign"></i>',
            'class' => 'btn btn-default'
        ],
    ]);
    ?>
    <?= $content ?>
    <?php
    Modal::end();
    ?>
</div>