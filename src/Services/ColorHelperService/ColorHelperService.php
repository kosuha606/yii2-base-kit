<?php

namespace kosuha606\Yii2BaseKit\Services\ColorHelperService;

/**
 * Class ColorHelperService
 * @package kosuha606\Yii2BaseKit\Services\ColorHelperService
 */
class ColorHelperService
{
    /**
     * @param $hex
     * @param int $alpha
     * @return string
     */
    public function hexToRgba($hex, $alpha = 1)
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return "rgba($r, $g, $b, $alpha)";
    }
}