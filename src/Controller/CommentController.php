<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 10/04/18
 * Time: 17:18
 */

namespace Controller;

use Model\CommentManager;
use Model\Format;

class CommentController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getComments()
    {
        $commentsManager = new CommentManager();
        $results = $commentsManager->selectAllCommentAndJob();

        $formater = new Format();
        $datas = $formater->commentJob($results);

        return $this->twig->render('Admin/comment.html.twig', ['datas' => $datas]);
    }

    public function addComment(int $jobId)
    {
        if(!empty($_POST)) {
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

            header('Location:/job/'.$data['job_id'].'/add-comment');
            exit();
        }

        return $this->twig->render('comment.html.twig', ['jobId' => $jobId]);
    }

    public function commentView(int $id)
    {
        $commentManager = new CommentManager();
        $results = $commentManager->selectCommentAndJob($id);

        $formater = new Format();
        $data = $formater->commentJob($results);

        return $this->twig->render('Admin/view_comment.html.twig', ['data' => $data]);
    }

    public function commentUpdate()
    {
        if(!empty($_POST['id'])) {
            $id = $_POST['id'];
            $commentManager = new CommentManager();
            if ($_POST['avatar'] == 'yes') {
                $comment = $commentManager->selectOneById($id);
                $data['avatar'] = $comment->getAvatar();
            } else {
                $data['avatar'] = '/assets/images/default_avatar.jpg';
            }
            $data['valid'] = 1;

            $commentManager->update($id, $data);
        }
        return $this->getComments();
    }
}