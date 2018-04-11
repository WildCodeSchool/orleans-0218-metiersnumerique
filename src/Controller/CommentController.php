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
use Model\Job;
use Model\JobManager;

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
        /*$commentManager = new CommentManager();
        $commentsWithJobName = $commentManager->selectAllCommentsByJob();*/

        $comments = new CommentManager();
        $comments = $comments->selectAllOrderByState();
        $jobs = new JobManager();
        $jobs = $jobs->selectAll();
//        var_dump($jobs); die();
        return $this->twig->render('Admin/comment.html.twig', ['comments' => $comments, 'jobs' => $jobs]);
    }
}