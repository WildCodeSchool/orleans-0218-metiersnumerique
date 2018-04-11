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
        $errors = '';
        if (!empty($_POST)) {
            $idJob = intval($_POST['idJob']);
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            if (isset($_POST['wilder'])) {
                $wilder = $_POST['wilder'];
            } else {
                $wilder = 'off';
            }
            $profession = $_POST['profession'];
            $company = $_POST['company'];
            $q1 = $_POST['q1'];
            $q2 = $_POST['q2'];
            $q3 = $_POST['q3'];
            $like = 0;
            $date = date("Y-m-d H:i:s"); //(le format DATETIME de MySQL)
            $valid = 0;
            $avatar = "default value";
            $commentManager = new CommentManager();
            $commentManager->insertComment($idJob, $lastname, $firstname, $email, $wilder, $profession, $company, $q1, $q2, $q3, $like, $date, $valid, $avatar);
        } else {
            $errors = 'il ne faut pas de champ vide !';
        }

        //return $errors;
    }
}