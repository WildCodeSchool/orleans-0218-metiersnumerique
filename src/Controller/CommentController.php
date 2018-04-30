<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 10/04/18
 * Time: 17:18
 */

namespace Controller;

use Model\CleanInput;
use Model\CommentManager;
use Model\Format;
use Model\JobManager;
use Validator\Comment;
use Validator\EmailValidator;
use Validator\NotEmptyValidator;
use Validator\MaxLengthValidator;
use Validator\ExtensionUploadValidator;
use Validator\SizeUploadValidator;
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

    /**
     * @param int $jobId
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function addComment(int $jobId): string
    {
        $jobManager = new JobManager();
        $job = $jobManager->selectOneById($jobId);
        if (!empty($_POST)) {

            $cleaner = new CleanInput();

            $data = $cleaner->clean($_POST);

            if (isset($_POST['wilder'])) {
                $data['wilder'] = $_POST['wilder'];
            } else {
                $data['wilder'] = 0;
            }


            $data['like'] = 0;
            $data['date'] = date("Y-m-d H:i:s"); //(le format DATETIME de MySQL)
            $data['valid'] = 0;

            $toValidate = [
                'lastname' => [new NotEmptyValidator($data['lastname']),
                                new MaxLengthValidator($data['lastname'], 45)],
                'firstname' => [new NotEmptyValidator($data['firstname']),
                                new MaxLengthValidator($data['firstname'], 45)],
                'email' => [new NotEmptyValidator($data['email']),
                            new MaxLengthValidator($data['email'], 255),
                            new EmailValidator($data['email'])],
                'profession' => [new NotEmptyValidator($data['profession']),
                                new MaxLengthValidator($data['profession'], 45)],
                'company' => [new NotEmptyValidator($data['company']),
                                new MaxLengthValidator($data['company'], 45)],
                'question1' => [new NotEmptyValidator($data['question1']),
                                new MaxLengthValidator($data['question1'], 255)],
                'question2' => [new NotEmptyValidator($data['question2']),
                                new MaxLengthValidator($data['question2'], 255)],
                'question3' => [new NotEmptyValidator($data['question3']),
                                new MaxLengthValidator($data['question3'], 255)],
            ];

            if(!empty($_FILES['avatar']['name'])) {
                $toValidate['avatar'] = [
                    new ExtensionUploadValidator($_FILES['avatar']['type']),
                    new SizeUploadValidator($_FILES['avatar']['size'])];
            }

            $commentValidator = new Comment($toValidate);

            $boolErrors = $commentValidator->isValid();

            $errors = $commentValidator->getErrors();


            if (!$boolErrors) {
                return $this->twig->render('comment.html.twig', ['job' => $job, 'inputs' => $data, 'errors' => $errors]);
            } else {

                if(!empty($_FILES['avatar']['name'])) {
                    $fileName = $_FILES["avatar"]["name"];
                    $tempFile = $_FILES["avatar"]["tmp_name"];
                    $extension = pathinfo($fileName,PATHINFO_EXTENSION);
                    $dirTarget = "assets/images/avatar/".uniqid("image").".".$extension;
                    if(move_uploaded_file($tempFile, $dirTarget)) {
                        $data['avatar'] = $dirTarget;
                    } else {
                        $data['avatar'] = 'assets/images/avatar/default_avatar.jpg';
                    }
                } else {
                    $data['avatar'] = 'assets/images/avatar/default_avatar.jpg';
                }

                $commentManager = new CommentManager();
                $commentManager->insert($data);

                header('Location:/job/' . $data['job_id']);
                exit();
            }
        }

        return $this->twig->render('comment.html.twig', ['job' => $job]);
    }

    public function commentView(int $id)
    {
        $commentManager = new CommentManager();
        $results = $commentManager->selectCommentAndJob($id);

        $formater = new Format();
        $data = $formater->commentJob($results);

        return $this->twig->render('Admin/view-comment.html.twig', ['data' => $data]);
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
                $data['avatar'] = 'assets/images/avatar/default_avatar.jpg';
            }
            $data['valid'] = 1;

            $commentManager->update($id, $data);
        }
        return $this->getComments();
    }

    public function loadComments()
    {
        if (!empty($_POST)) {
            $jobId = $_POST['jobId'];
            $offset = $_POST['offset'];
            $commentManager = new CommentManager();
            $comments = $commentManager->selectCommentsByJobId($jobId, $offset);
        } else {
            header('Location:/jobs');
            exit();
        }

        return $this->twig->render('load-comment.html.twig', ['comments' => $comments]);
    }

    public function addLike()
    {
        $commentManager = new CommentManager();

        if (!empty($_POST)) {
            $commentId = $_POST['commentId'];

            if (!isset($_COOKIE["like$commentId"])) {
                $commentManager->addLikeByCommentId($commentId);
                setcookie('like'.$commentId, true);
            }
        }
        $nbLike = $commentManager->selectNbLikeByCommentId($commentId);

        return $nbLike;
    }

    public function deleteComment()
    {
        if (!empty($_POST['id'])) {
            $commentManager = new CommentManager();
            $commentManager->deleteCommentAvatar($_POST['id']);
            $commentManager->delete($_POST['id']);
        }

        header('Location: /admin/comment');
        exit();
    }
}
