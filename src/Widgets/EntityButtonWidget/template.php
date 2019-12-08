<?php

use yii\helpers\Html;

/** @var $isNew */
/** @var $labels */

?>

<div class="buttons">
    <?php if ($isNew) : ?>
        <?= Html::submitButton($labels['new'], ['class' => 'btn btn-primary']) ?>
    <?php else : ?>
        <?= Html::submitButton($labels['update'], ['class' => 'btn btn-success']) ?>
    <?php endif; ?>
</div>
