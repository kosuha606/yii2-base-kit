<?php
/** @var $id */
/** @var $items */
/** @var ActiveForm $form */

/** @var $name */

/** @var $addButton */

use kartik\form\ActiveForm;
use yii\bootstrap\Modal;

?>
<div class="todolist-widget <?= !$addButton ? 'no-add-button' : '' ?>" id="<?= $id ?>"
     data-items='<?= Yii::$app->arrayHelperService->toJson($values) ?>'>
    <?php if ($addButton) { ?>
        <h4><?= $title ?>
            <span style="font-weight: normal;">
        <?php
        Modal::begin([
            'options' => [
                'id' => 'kartik-modal' . $id,
                'tabindex' => false // important for Select2 to work properly
            ],
            'header' => '<h4 style="margin:0; padding:0">Добавить</h4>',
            'toggleButton' => [
                'label' => '<i class="glyphicon glyphicon-plus"></i>',
                'class' => 'btn btn-success btn-xs'
            ],
        ]);
        ?>
                <input type="hidden" name="result-field-<?= $id ?>" value="<?= $name ?>"/>
                <?= $formHTML; ?>
                <?php
                Modal::end();
                ?>
            </span></h4>
    <?php } else { ?>
        <h4><?= $title ?></h4>
    <?php } ?>
    <table width="100%" class="table todolist-items">
    </table>
</div>
