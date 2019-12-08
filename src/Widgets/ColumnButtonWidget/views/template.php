<?php

use kosuha606\Yii2BaseKit\Helpers\UUIDGenerator;
use yii\bootstrap\Modal;

/** @var $label */
/** @var $id */
/** @var $formHtml */
/** @var $modalTitle */
/** @var $jsCallback */

$id = UUIDGenerator::v1();
?>
<div class="column-button-widget" id="<?= $id ?>" data-js-callback="<?= $jsCallback ?>">
    <?php
    Modal::begin([
        'options' => [
            'id' => 'kartik-modal' . $id,
            'tabindex' => false
        ],
        'header' => '<h4 style="margin:0; padding:0">' . $modalTitle . '</h4>',
        'toggleButton' => [
            'label' => $label,
            'class' => 'btn btn-default'
        ],
    ]);
    ?>
    <?= $formHtml ?>
    <?php
    Modal::end();
    ?>
</div>
