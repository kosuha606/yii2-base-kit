<?php

use kosuha606\Yii2BaseKit\Services\ArrayHelperService\ArrayHelperService;

if (!$value) {
    $value = 'Добавить';
}
/** @var ArrayHelperService $arrayHelperService */
$arrayHelperService = Yii::$app->arrayHelperService;
?>
<style>
    .lsv-reset {
        font-weight: bold;
    }
</style>
<div class="lsv-container" data-label-sync-point="<?= $labelSyncPoint ?>" data-save-to="<?= $saveTo ?>" data-save-to-relations="<?= htmlspecialchars($arrayHelperService->toJson($saveToRelations)) ?>">
    <input type="hidden" class="lsv-save-to" value="<?= $model->$attribute ?>" name="<?= $saveTo ?>">
    <?php if ($saveToRelations) { ?>
        <?php foreach ($saveToRelations as $type => $relation) { ?>
            <input type="hidden" class="lsv-save-to-<?= $type ?>" value="<?= $model->$type ?>" name="<?= $relation ?>">
        <?php } ?>
    <?php } ?>
    <a href="#" class="lsv-value"><?= $value ?></a>
    <a href="#" class="lsv-reset <?= $value === 'Добавить' ? 'hide' : '' ?>" title="Сбросить занчение">&times;</a>
    <!-- Modal to select value -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body dyngrid-form-wrapper">
                    <?= $this->render($formTemplate, [
                        'model' => $model,
                        'index' => $index,
                        'formTemplateData' => $formTemplateData,
                    ]) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary lsv-save">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>
