<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 18/04/18
 * Time: 11:25
 */

namespace Controller;


use Model\CleanInput;
use Validator\Comment;
use Model\JobManager;
use Model\ThemeManager;
use Validator\MaxLengthValidator;
use Validator\NotEmptyValidator;

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

    /**
     * @param int $themeId
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function updateTheme(int $themeId)
    {
        $themeManager = new ThemeManager();
        if (empty($_POST)) {
            $theme = $themeManager->selectOneById($themeId);

            if (!isset($_SESSION['updateTheme'])) {
                $_SESSION['updateTheme'] = '';
            }

            return $this->twig->render('Admin/modification_themes.html.twig', ['theme' => $theme,
                                                                            'updateTheme' => $_SESSION['updateTheme']]);
        } elseif (!empty($_POST)) {
            $cleaner = new CleanInput();
            $data = $cleaner->clean($_POST);

            $toValidate = [
                'name' => [new NotEmptyValidator($data['name']),
                    new MaxLengthValidator($data['name'], 255)],
            ];

            $validator = new Comment($toValidate);

            $isValid = $validator->isValid();

            if ($isValid) {
                if (isset($_SESSION['updateTheme'])) {
                    unset($_SESSION['updateTheme']);
                }
                $themeManager->update($_POST['id'], $data);
            } else {
                if (isset($_SESSION['updateTheme'])) {
                    unset($_SESSION['updateTheme']);
                }
                $array = $validator->getErrors();
                foreach ($array as $arr) {
                    $_SESSION['updateTheme'] = array_filter(array_values($arr));
                }
                header('Location: /admin/update-theme/'.$_POST['id']);
                exit();
            }



            header('Location: /admin/themes-jobs');
            exit();
        }
    }

    public function deleteTheme()
    {
        if (!empty($_POST)) {
            $jobManager = new JobManager();
            $nbJobs = $jobManager->countNbJobsByThemeId($_POST['id']);

            unset($_SESSION['deleteTheme']);



            $_SESSION['deleteTheme']['id'] = $_POST['id'];
            if ($nbJobs > 0) {
                $_SESSION['deleteTheme']['danger'] = 'Vous devez supprimer les fiches métiers avant de pouvoir supprimer le thème';
                header('Location:/admin/themes-jobs');
            } else {
                $themeManager = new ThemeManager();
                $themeManager->delete($_POST['id']);
                $_SESSION['deleteTheme']['success'] = 'Votre thème a bien été supprimé';
            }
        }
        header('Location:/admin/themes-jobs');
    }
}