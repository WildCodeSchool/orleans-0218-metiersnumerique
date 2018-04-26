<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 11:30
 */

namespace Controller;

use Model\CommentManager;
use Model\Job;
use Model\JobManager;
use Model\ThemeManager;

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

            }else{

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


}
