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
use Model\Paginator;

class CommentController extends AbstractController
{
    /**
     * @param int $pageId
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getComments(int $pageId = 1)
    {
        $commentManager = new CommentManager();
        $nbComments = $commentManager->countNbComments();

        $order = ['valid' => 'asc', 'date' => 'desc'];
        $paginator = new Paginator($commentManager, $pageId, $nbComments, $order);
        $comments = $paginator->paginate();

        $datas['nbPages'] = $comments['nbPages'];
        $datas['pageId'] = $comments['pageId'];

        $jobManager = new JobManager();
        foreach ($comments[0] as $comment) {
            $datas['data'][] = ['comment' => $comment,
                'job' => $jobManager->selectOneById($comment->getJobId())];
        }

        return $this->twig->render('Admin/comment.html.twig', ['datas' => $datas, 'pageId' => $pageId]);
    }

    public function addComment(int $jobId)
    {
        if (!empty($_POST)) {
            $data['job_id'] = intval($_POST['idJob']);
            $data['lastname'] = trim($_POST['lastname']);
            $data['firstname'] = trim($_POST['firstname']);
            $data['email'] = trim($_POST['email']);
            if (isset($_POST['wilder'])) {
                $data['wilder'] = 1;
            } else {
                $data['wilder'] = 0;
            }
            $data['profession'] = trim($_POST['profession']);
            $data['company'] = trim($_POST['company']);
            $data['question1'] = trim($_POST['q1']);
            $data['question2'] = trim($_POST['q2']);
            $data['question3'] = trim($_POST['q3']);
            $data['like'] = 0;
            $data['date'] = date("Y-m-d H:i:s"); //(le format DATETIME de MySQL)
            $data['valid'] = 0;
            $data['avatar'] = "default value";
            $commentManager = new CommentManager();
            $commentManager->insert($data);

            header('Location:/job/' . $data['job_id'] . '/add-comment');
            exit();
        }

        return $this->twig->render('comment.html.twig', ['jobId' => $jobId]);
    }
}