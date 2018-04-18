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

            $data['job_id'] = $_POST['idJob'];
            $data['lastname'] = $_POST['lastname'];
            $data['firstname'] = $_POST['firstname'];
            $data['email'] = $_POST['email'];

            $data['profession'] = $_POST['profession'];
            $data['company'] = $_POST['company'];
            $data['question1'] = $_POST['q1'];
            $data['question2'] = $_POST['q2'];
            $data['question3'] = $_POST['q3'];
            if (isset($_POST['wilder'])) {
                $data['wilder'] = $_POST['wilder'];
            } else {
                $data['wilder'] = 0;
            }

            $data = $cleaner->clean($data);

            $data['like'] = 0;
            $data['date'] = date("Y-m-d H:i:s"); //(le format DATETIME de MySQL)
            $data['valid'] = 0;
            $data['avatar'] = '/assets/images/default_avatar.png';

            $toValidate = [
                'lastname' => [new NotEmptyValidator($data['lastname']),
                                new MaxLengthValidator($data['lastname'], VALID_MAX_LENGTH_INPUTS)],
                'firstname' => [new NotEmptyValidator($data['firstname']),
                                new MaxLengthValidator($data['firstname'], VALID_MAX_LENGTH_INPUTS)],
                'email' => [new NotEmptyValidator($data['email']),
                            new MaxLengthValidator($data['email'], VALID_MAX_LENGTH_EMAIL),
                            new EmailValidator($data['email'])],
                'profession' => [new NotEmptyValidator($data['profession']),
                                new MaxLengthValidator($data['profession'], VALID_MAX_LENGTH_INPUTS)],
                'company' => [new NotEmptyValidator($data['company']),
                                new MaxLengthValidator($data['company'], VALID_MAX_LENGTH_INPUTS)],
                'question1' => [new NotEmptyValidator($data['question1']),
                                new MaxLengthValidator($data['question1'], VALID_MAX_LENGTH_TEXTAREA)],
                'question2' => [new NotEmptyValidator($data['question2']),
                                new MaxLengthValidator($data['question2'], VALID_MAX_LENGTH_TEXTAREA)],
                'question3' => [new NotEmptyValidator($data['question3']),
                                new MaxLengthValidator($data['question3'], VALID_MAX_LENGTH_TEXTAREA)],
            ];

            $commentValidator = new Comment($toValidate);

            $boolErrors = $commentValidator->isValid();

            $errors = $commentValidator->getErrors();

            if (!$boolErrors) {
                return $this->twig->render('comment.html.twig', ['job' => $job, 'inputs' => $data, 'errors' => $errors]);
            } else {
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