<?php

use app\services\SL;

// TODO move it to js resources
$script = <<<JS
$("#{$formId}").addel({
    hide: true
});

$('#{$formId}').on('addel:added', function(e) {
    var itemKey = '';
    $('#{$formId} .addel-item').each(function(e, o) {
        itemKey = getUUID();
        $(o).find('[data-name]').each(function(ie, io) {
            var dataName = $(io).attr('data-name');
            $(io).attr('name', dataName + '[' + itemKey + ']')
        });
    });
    Main.handleJsTree();
});

$('#{$formId}').trigger('addel:added');

$('.unaddel-target .addel-delete').on('click', function(e) {
    e.preventDefault();
    $(this).closest('.row').remove();
});
JS;
$this->registerJs($script);
$fields = SL::o()->fieldService->getToList();
/** @var $items */
/** @var $formId */
/** @var $formTemplate */

?>
<div id="<?= $formId ?>">
    <div class="unaddel-target">
        <?php foreach ($items as $item) { ?>
        <div class="form-group row addel-item">
            <div class="col-md-12">
                <div class="pull-left">
                    <?= $this->render($formTemplate, $item) ?>
                </div>
                <button type="button" class="btn btn-danger pull-right addel-delete">
                    <i class="glyphicon glyphicon-remove"></i>
                </button>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="form-group addel-target addel-item">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <?= $this->render($formTemplate) ?>
                </div>
                <button type="button" class="btn btn-danger pull-right addel-delete">
                    <i class="glyphicon glyphicon-remove"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success addel-add">
            <i class="glyphicon glyphicon-plus"></i>
            Добавить
        </button>
    </div>
</div>
