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
use Model\Upload;
use Validator\ExtensionUploadValidator;
use Validator\SizeUploadValidator;
use Validator\NotEmptyValidator;
use Validator\MaxLengthValidator;
use Validator\ResUploadValidator;
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

        return $this->twig->render('Jobs/jobs.html.twig', ['themes' => $themes, 'jobs' => $jobs, 'comments' => $comments]);
    }

    public function getOneJobById(int $id)
    {
        $jobManager = new JobManager();
        $job = $jobManager->selectOneById($id);
        $commentManager = new CommentManager();
        $comments = $commentManager->selectCommentsByJobId($id);

        return $this->twig->render('job.html.twig', ['job' => $job, 'comments' => $comments]);
    }

    public function deleteJob()
    {
        if (!empty($_POST)) {
            $jobManager = new JobManager();
            $_SESSION['deleteJob']['id'] = $_POST['id'];
            $isDeleted = $jobManager->delete($_POST['id']);
          
            if ($isDeleted) {
                $_SESSION['deleteJob']['success'] = 'Votre fiche a bien été supprimé';
            } else {
                $_SESSION['deleteJob']['danger'] = 'Votre fiche n\'a pas été supprimée';
            }
        }
      
        if (!empty($_POST['thumbnail'])) {
            $fichier = $_POST['thumbnail'];
            if (file_exists($fichier))
                unlink($fichier);
        }
        if (!empty($_POST['image'])) {
            $fichier = $_POST['image'];
            if (file_exists($fichier))
                unlink($fichier);
        }

        header('Location: /admin/themes-jobs');
    }

    public function updateJob(int $jobId)
    {
        $themeManager = new ThemeManager();
        $themes = $themeManager->selectAll();
        $jobManager = new JobManager();
        if (empty($_POST)) {
            $job = $jobManager->selectOneById($jobId);
            if (!isset($_SESSION['updateJob'])) {
                $_SESSION['updateJob'] = '';
            }
            return $this->twig->render('Admin/update-job.html.twig', ['themes' => $themes, 'job' => $job,
                'updateJob' => $_SESSION['updateJob']]);
        } elseif (!empty($_POST)) {
            $cleaner = new CleanInput();
            $data = $cleaner->clean($_POST);
            $toValidate = [
                'theme_id' => [new MaxLengthValidator($data['theme_id'], 11)],
                'video' => [new MaxLengthValidator($data['video'], 255)],
                'name' => [new NotEmptyValidator($data['name']),
                    new MaxLengthValidator($data['name'], 255)],
                'description' => [new NotEmptyValidator($data['description']),
                    new MaxLengthValidator($data['description'], 1000)],
                'resum' => [new NotEmptyValidator($data['resum']),
                    new MaxLengthValidator($data['resum'], 300)],
                'thumbnail' => [new ExtensionUploadValidator($_FILES['thumbnail']['type']),
                    new SizeUploadValidator($_FILES['thumbnail']['size']),
                    new NotEmptyValidator($_FILES['thumbnail']['name'])],
            ];

            if (!empty($_FILES['thumbnail']['tmp_name'])) {
                $thumbResValidate = new ResUploadValidator($_FILES['thumbnail']['tmp_name'], 250);
                array_push($toValidate['thumbnail'], $thumbResValidate);
            }

            if (!empty($_FILES['image']['tmp_name'])) {
                $extensionUpload = new ExtensionUploadValidator($_FILES['image']['type']);
                $sizeUpload = new SizeUploadValidator($_FILES['image']['size']);
                $maxLengthUpload = new MaxLengthValidator($_FILES['image']['name'], 255);
                array_push($toValidate['image'], $extensionUpload);
                array_push($toValidate['image'], $sizeUpload);
                array_push($toValidate['image'], $maxLengthUpload);
            } else {
                $data['image'] = '';
            }

            $commentValidator = new Comment($toValidate);
            $boolErrors = $commentValidator->isValid();
            $errors = $commentValidator->getErrors();
          
            if (!$boolErrors) {
                return $this->twig->render('Admin/update-job.html.twig', ['themes' => $themes, 'inputs' => $data, 'errors' => $errors]);
            } else {
                $upload = new Upload();
                $idUpload = uniqid();
                $data['thumbnail'] = $upload->renameFile($data['name'], 'card-metiers', 'thumbnail', $idUpload);
                $data['image'] = $upload->renameFile($data['name'], 'image-metiers', 'image', $idUpload);
                $jobManager = new JobManager();
                $jobManager->insert($data);
                $upload->upload($data['name'], 'card-metiers', 'thumbnail', $idUpload);
                $upload->upload($data['name'], 'image-metiers', 'image', $idUpload);
                header('Location:/admin/themes-jobs');
                exit();
            }
        }
        return $this->twig->render('Admin/update-job.html.twig', ['themes' => $themes]);
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


            if (!empty($_FILES['thumbnail']['tmp_name'])) {
                $thumbResValidate = new ResUploadValidator($_FILES['thumbnail']['tmp_name'], 250);
                array_push($toValidate['thumbnail'], $thumbResValidate);
            }


            if (!empty($_FILES['image']['tmp_name'])) {
                $extensionUpload = new ExtensionUploadValidator($_FILES['image']['type']);
                $sizeUpload = new SizeUploadValidator($_FILES['image']['size']);
                $maxLengthUpload = new MaxLengthValidator($_FILES['image']['name'], 255);
                array_push($toValidate['image'], $extensionUpload);
                array_push($toValidate['image'], $sizeUpload);
                array_push($toValidate['image'], $maxLengthUpload);

            } else {
                $data['image'] = '';
            }

            $commentValidator = new Comment($toValidate);

            $boolErrors = $commentValidator->isValid();

            $errors = $commentValidator->getErrors();

            if (!$boolErrors) {
                return $this->twig->render('Admin/add-job.html.twig', ['themes' => $themes, 'inputs' => $data, 'errors' => $errors]);
            } else {

                $upload = new Upload();
                $idUpload = uniqid();
                $data['thumbnail'] = $upload->renameFile($data['name'], 'card-metiers', 'thumbnail', $idUpload);
                $data['image'] = $upload->renameFile($data['name'], 'image-metiers', 'image', $idUpload);
                $jobManager = new JobManager();
                $jobManager->insert($data);
                $upload->upload($data['name'], 'card-metiers', 'thumbnail', $idUpload);
                $upload->upload($data['name'], 'image-metiers', 'image', $idUpload);

                header('Location:/admin/themes-jobs');
                exit();
            }
        }

        return $this->twig->render('Admin/add-job.html.twig', ['themes' => $themes]);
    }

}

