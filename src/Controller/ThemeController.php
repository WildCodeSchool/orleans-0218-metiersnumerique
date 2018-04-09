<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 10:36
 */

namespace Controller;

use Model\Theme;
use Model\ThemeManager;
use Controller\JobController;


class ThemeController extends AbstractController
{
    public function showThemes()
    {
        $themeManager = new ThemeManager();
        $themes = $themeManager->selectAll();

        $jobController = new JobController();
        $jobs = $jobController->getAllJobs();

        return $this->twig->render('Jobs/themes.html.twig', ['themes' => $themes, 'jobs' => $jobs]);
    }
}