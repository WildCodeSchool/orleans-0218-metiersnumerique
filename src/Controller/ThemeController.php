<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 18/04/18
 * Time: 11:25
 */

namespace Controller;


use Model\Session;
use Model\ThemeManager;

class ThemeController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function addTheme()
    {
        if (!empty($_POST['themeName'])) {
            session_start();
            if (isset($_SESSION['addTheme'])) {
                unset($_SESSION['addTheme']);
            }
            $themeManager = new ThemeManager();
            $themeName['name'] = $_POST['themeName'];

            /* Ajout des validations (classe en développement par Steven) */

            $insertReturn = $themeManager->insert($themeName);

            if ($insertReturn == true) {
                $_SESSION['addTheme']['success'] = 'Le thème a été ajouté !';
            } elseif ($insertReturn == false) {
                $_SESSION['addTheme']['danger'] = 'L\'ajout du thème a échoué...';
            }
        }

        header('Location:/admin/themes-jobs');
        exit();
    }
}