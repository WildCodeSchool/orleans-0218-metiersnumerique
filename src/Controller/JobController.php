<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 11:30
 */

namespace Controller;

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
//        var_dump($jobs);
//        die();

        return $this->twig->render('Jobs/jobs.html.twig', ['themes' => $themes, 'jobs' => $jobs]);
    }

    public function getOneJobById(int $id)
    {
        $jobManager = new JobManager();
        $job = $jobManager->selectOneById($id);

        return $this->twig->render('job.html.twig', ['job' => $job]);
    }
}
