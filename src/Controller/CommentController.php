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

    public function addComment()
    {
        if (!empty($_POST)) {

        } else {
            $errors[] = 'Il ne faut pas de champ vide !';
        }

        if(empty($errors)) {
            $datas['job_id'] = intval($_POST['idJob']);
            $datas['lastname'] = trim($_POST['lastname']);
            $datas['firstname'] = trim($_POST['firstname']);
            $datas['email'] = trim($_POST['email']);
            if (isset($_POST['wilder'])) {
                $datas['wilder'] = 1;
            } else {
                $datas['wilder'] = 0;
            }
            $datas['profession'] = trim($_POST['profession']);
            $datas['company'] = trim($_POST['company']);
            $datas['question1'] = trim($_POST['q1']);
            $datas['question2'] = trim($_POST['q2']);
            $datas['question3'] = trim($_POST['q3']);
            $datas['like'] = 0;
            $datas['date'] = date("Y-m-d H:i:s"); //(le format DATETIME de MySQL)
            $datas['valid'] = 0;
            $datas['avatar'] = "default value";
            $commentManager = new CommentManager();
            $commentManager->insert($datas);

            header('Location: /job/comment/'.$datas['job_id']);
            exit();
        }
    }
}