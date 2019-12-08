<?php

/** @var array $options */

?>
<?php foreach ($options['buttons'] as $key => $button) { ?>
    <?php if ($button['type'] == 'button') { ?>
        <?= \yii\helpers\Html::button($button['label'],
            ['type' => 'button', 'name' => $button['name'], 'class' => $button['class'], 'id' => $button['id']]) ?>
    <?php } else { ?>
        <?= \yii\helpers\Html::a($button['label'], $button['name'],
            ['class' => $button['class']]) ?>
    <?php } ?>
<?php } ?>
