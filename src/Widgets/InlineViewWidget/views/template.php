<?php

/** @var $data */
/** @var $fixedCol */

if ($fixedCol) {
    $fullWidthCols = count($data) - 1;
    $oneFullWidthCol = round(100 / $fullWidthCols)-1;
}
?>
<table>
    <tr>
        <?php foreach ($data as $colInd => $datum) { ?>
            <td width="<?= $colInd == $fixedCol ? '1%' : $oneFullWidthCol.'%' ?>" style="padding-right: 5px">
                <?= $datum ?>
            </td>
        <?php } ?>
    </tr>
</table>
