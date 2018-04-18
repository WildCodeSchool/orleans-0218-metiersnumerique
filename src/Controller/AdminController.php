<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 18/04/18
 * Time: 10:39
 */

namespace Controller;


use Model\JobManager;
use Model\ThemeManager;

class AdminController extends AbstractController
{
    public function showThemesAndJobs()
    {
        $themeManager = new ThemeManager();
        $themes = $themeManager->selectAll();

        $jobManager = new JobManager();
        $jobs = $jobManager->selectAll();

        return $this->twig->render('Admin/themes-jobs.html.twig', ['themes' => $themes, 'jobs' => $jobs]);
    }
}