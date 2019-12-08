<?php

namespace kosuha606\Yii2BaseKit\Services\TreeService;

class TreeService
{
    /**
     * Этот метод адаптирует переданные данные иерархии
     * к определенному формату, может быть использовано
     * для адаптации данных к JS библиотекам.
     *
     * @param $data - данные для изменения
     * @param $config - Конфигурация модификации данных
     * @return []
     */
    public function adaptHierarchyData(
        $data,
        $config = [
            'root' => ['from' => '0', 'to' => '#'],
            'parent' => ['from' => 'parent_id', 'to' => 'parent'],
            'label' => ['from' => 'name', 'to' => 'text']
        ]
    ) {
        foreach ($data as &$datum) {
            // Адаптируем parent_id к нужному формату для корневого элемента
            if ($datum[$config['parent']['from']] === $config['root']['from']) {
                $datum[$config['parent']['from']] = $config['root']['to'];
            }
            // Адаптируем ключ родителя
            $datum[$config['parent']['to']] = $datum[$config['parent']['from']];
            // Адаптируем ключ для лэйбла
            $datum[$config['label']['to']] = $datum[$config['label']['from']];
        }

        return $data;
    }
}