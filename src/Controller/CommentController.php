<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 10/04/18
 * Time: 17:18
 */

namespace Controller;


use Model\Comment;
use Model\CommentManager;

class CommentController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getComment()
    {
        $commentManager = new CommentManager();
        $commentsWithJobName = $commentManager->selectAllCommentsByJob();

        return $this->twig->render('Admin/comment.html.twig', ['comments' => $commentsWithJobName]);
    }
}