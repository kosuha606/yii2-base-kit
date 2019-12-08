<?php

namespace kosuha606\Yii2BaseKit\Builders\TreeBuilder;

/**
 * Class TreeBuilder
 * @package kosuha606\Yii2BaseKit\Builders\TreeBuilder
 */
class TreeBuilder
{
    /**
     * @param $mess
     * @return array|bool
     */
    public static function formTree($mess)
    {
        if (!is_array($mess)) {
            return false;
        }
        $tree = array();
        foreach ($mess as $value) {
            $parentId = $value['parent_id'];
            if (!$parentId) {
                $parentId = 0;
            }
            $tree[$parentId][] = $value;
        }
        return $tree;
    }

    /**
     * @param $cats
     * @param $parent_id
     * @param $selectedId
     * @return bool|string
     */
    public static function buildTree($cats, $parent_id, $selectedId)
    {
        if (is_array($cats) && isset($cats[$parent_id])) {
            $tree = '<ul>';
            foreach ($cats[$parent_id] as $cat) {
                $subTree = self::buildTree($cats, $cat['id'], $selectedId);
                if ($cat['id'] == $selectedId || preg_match('/jstree-open/i', $subTree)) {
                    $clicked = $cat['id'] == $selectedId ? 'jstree-clicked' : '';
                    $tree .= '<li class="jstree-open"><a class="'.$clicked.'" href="/private/category/'.$cat['id'].'">' . $cat['title'].'</a>';
                } else {
                    $tree .= '<li><a href="/private/category/'.$cat['id'].'">' . $cat['name'].'</a>';
                }
                $tree .= $subTree;
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        } else {
            return false;
        }
        return $tree;
    }
}