<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 14:44
 */
namespace Controller;
use Model\Comment;
use Model\CommentManager;
class CommentController extends AbstractController
{
    public function getAllCommentByJob(): array
    {
        $commentManager = new CommentManager();
        $comments = $commentManager->selectAllCommentsByJob();
        return $comments;
    }
}