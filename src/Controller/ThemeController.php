<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 18/04/18
 * Time: 11:25
 */

namespace Controller;


use Model\ThemeManager;
use Validator\NotEmptyValidator;

class ThemeController extends AbstractController
{
    /**
     * @return string
     */
    public function addTheme()
    {
        if (isset($_SESSION['addTheme'])) {
            unset($_SESSION['addTheme']);
        }

        $validator = new NotEmptyValidator($_POST['themeName']);
        $isValid = $validator->isValid();

        if ($isValid == true) {
            $themeManager = new ThemeManager();
            $themeName['name'] = $_POST['themeName'];
            $insertReturn = $themeManager->insert($themeName);

            if ($insertReturn == true) {
                $_SESSION['addTheme']['success'] = 'Le thème a été ajouté !';
            } elseif ($insertReturn == false) {
                $_SESSION['addTheme']['danger'] = 'L\'ajout du thème a échoué...';
            }
        } else {
            $_SESSION['addTheme']['danger'] = 'Le champ ne peut pas être vide...';
        }

        header('Location:/admin/themes-jobs');
        exit();
    }
}