<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 11:30
 */

namespace Controller;

use Model\CleanInput;
use Model\CommentManager;
use Model\Job;
use Model\JobManager;
use Model\ThemeManager;
use Validator\ExtensionUploadValidator;
use Validator\SizeUploadValidator;
use Validator\NotEmptyValidator;
use Validator\MaxLengthValidator;
use Validator\Comment;

class JobController extends AbstractController
{
    public function showJobs()
    {
        $themeManager = new ThemeManager();
        $themes = $themeManager->selectAll();

        $jobController = new JobManager();
        $jobs = $jobController->selectAllOrderByThemeId();

        $commentManager = new CommentManager();
        $comments = $commentManager->selectNbCommentsByJob();

        return $this->twig->render('Jobs/jobs.html.twig', ['themes' => $themes, 'jobs' => $jobs, 'comments' => $comments ]);
    }

    public function getOneJobById(int $id)
    {
        $jobManager = new JobManager();
        $job = $jobManager->selectOneById($id);
        $commentManager = new CommentManager();
        $comments = $commentManager->selectCommentsByJobId($id);

        return $this->twig->render('job.html.twig', ['job' => $job, 'comments' => $comments]);
    }


    public function addJob()
    {

        $themeManager = new ThemeManager();
        $themes = $themeManager->selectAll();

        if (!empty($_POST)) {

            $cleaner = new CleanInput();

            $data = $cleaner->clean($_POST);

            $toValidate = [
                'theme_id' => [new MaxLengthValidator($data['theme_id'], 11)],
                'video' => [new MaxLengthValidator($data['video'], 255)],
                'name' => [new NotEmptyValidator($data['name']),
                    new MaxLengthValidator($data['name'], 255)],
                'description' => [new NotEmptyValidator($data['description']),
                    new MaxLengthValidator($data['description'], 255)],
                'resum' => [new NotEmptyValidator($data['resum']),
                    new MaxLengthValidator($data['resum'], 255)],
                'thumbnail' => [new ExtensionUploadValidator($_FILES['thumbnail']['type']),
                    new SizeUploadValidator($_FILES['thumbnail']['size']),

                    new NotEmptyValidator($_FILES['thumbnail']['name'])],
            ];
            if (!empty($_FILES['image']['name'])) {
                $toValidate = [
                    'image' => [new ExtensionUploadValidator($_FILES['image']['type']),
                    new SizeUploadValidator($_FILES['image']['size']),
                    new MaxLengthValidator($_FILES['image']['name'], 255)]
                ];
            } else {
                $data['thumbnail'] = '';
            }

            $commentValidator = new Comment($toValidate);

            $boolErrors = $commentValidator->isValid();

            $errors = $commentValidator->getErrors();

            if (!$boolErrors) {
                return $this->twig->render('Admin/add-job.html.twig', ['themes' => $themes, 'inputs' => $data, 'errors' => $errors]);
            } else {
                $jobManager = new JobManager();
                $jobManager->insert($data);

                header('Location:/admin/add-job/');
              exit();
            }
        }

        return $this->twig->render('Admin/add-job.html.twig', ['themes' => $themes]);
    }
}

