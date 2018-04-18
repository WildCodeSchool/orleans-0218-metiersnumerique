<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 18/04/18
 * Time: 11:25
 */

namespace Controller;


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
            $themeManager = new ThemeManager();
            $themeName['name'] = $_POST['themeName'];

            /* Ajout des validations (classe en développemet par Steven) */

            $insertReturn = $themeManager->insert($themeName);
        }

        return $this->twig->render('Admin/themes-jobs.html.twig', ['insertReturn' => $insertReturn]);
    }
}