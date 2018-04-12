<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 10/04/18
 * Time: 17:18
 */

namespace Controller;


use Model\CommentManager;
use Model\JobManager;

class CommentController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getCommentWithJobName()
    {
        $comments = new CommentManager();
        $comments = $comments->selectAllCommentOrderByStateAndDate();
        $jobs = new JobManager();
        $jobs = $jobs->selectAll();

        return $this->twig->render('Admin/comment.html.twig', ['comments' => $comments, 'jobs' => $jobs]);
    }
}