<?php

namespace kosuha606\Yii2BaseKit\Helpers;

use app\ARs\Log;
use app\services\SL;

/**
 * Class AdminHelper
 * @package kosuha606\Yii2BaseKit\Helpers
 */
class AdminHelper
{
    /**
     * @param $value
     * @return string
     */
    public static function boolFormat($value)
    {
        return $value ? '<i class="glyphicon glyphicon-ok"></i>' : '<i class="glyphicon glyphicon-remove"></i>';
    }

    /**
     * Получить строку как название колонки в
     * Excel по числу
     * @param $num
     * @return string
     */
    public static function getNameFromNumber($num)
    {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return self::getNameFromNumber($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }

    /**
     * @param $serviceClass
     * @return array|mixed|string
     */
    public static function serviceClassToServiceName($serviceClass)
    {
        $t = explode('\\', $serviceClass);
        $t = array_pop($t);
        $t = lcfirst($t);
        return $t;
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function getNumberFromName($name)
    {
        try {
            $res =  \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($name);
        } catch (\Exception $e) {
            SL::o()->logService->handleException(Log::TYPE_ERROR, 'Ошибка перевода строки в число', $e);
        }
        return $res;
    }
}