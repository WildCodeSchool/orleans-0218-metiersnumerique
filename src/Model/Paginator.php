<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 16/04/18
 * Time: 16:10
 */

namespace Model;


class Paginator
{
    public function paginateComments($limit, $pageId, $nbPages)
    {
        $pattern = '/\D/';

        if ($pageId > $nbPages) {
            $pageId = $nbPages;
        } elseif ($pageId < 1 || preg_match($pattern, $pageId)) {
            $pageId = 1;
        }

        $offset = $pageId * $limit - $limit;

        $commentManager = new CommentManager();
        $result = $commentManager->selectAllCommentAndJob($limit, $offset);

        return $result;
    }
}