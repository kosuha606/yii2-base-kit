<?php

namespace kosuha606\Yii2BaseKit\Data;

use yii\base\BaseObject;

/**
 * Class Pagination
 * @package kosuha606\Yii2BaseKit\Data
 */
class Pagination extends BaseObject
{
    /**
     * @var int
     */
    public $totalRows = 0;

    /**
     * @var int
     */
    public $currentPage;

    /**
     * @var int
     */
    public $perPage = 15;

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->perPage;
    }

    /**
     * @return float|int
     */
    public function getOffset()
    {
        return ($this->currentPage-1)*$this->perPage;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'totalRows' => (int)$this->totalRows,
            'currentPage' => (int)$this->currentPage,
            'perPage' => (int)$this->perPage,
        ];
    }
}