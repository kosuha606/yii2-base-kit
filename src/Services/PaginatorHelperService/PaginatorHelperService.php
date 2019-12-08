<?php

namespace kosuha606\Yii2BaseKit\Services\PaginatorHelperService;

use yii\data\Pagination;

class PaginatorHelperService
{
    public function getFromLimit($page, $pageCount, $total)
    {
        $paginator = new Pagination([
            'totalCount' => $total,
            'page' => $page,
            'pageSize' => $pageCount
        ]);

        return [
            'offset' => $paginator->getOffset(),
            'limit' => $paginator->getLimit(),
        ];
    }
}