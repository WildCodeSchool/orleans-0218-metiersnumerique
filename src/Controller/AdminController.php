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
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showThemesAndJobs()
    {
        session_start();

        $themeManager = new ThemeManager();
        $themes = $themeManager->selectAll();

        $jobManager = new JobManager();
        $jobs = $jobManager->selectAll();

        if (isset($_SESSION['addTheme'])) {
            $session = $_SESSION['addTheme'];
            unset($_SESSION['addTheme']);
        } else {
            $session = '';
        }

        return $this->twig->render('Admin/themes-jobs.html.twig', ['themes' => $themes, 'jobs' => $jobs, 'session' => $session]);
    }
}