<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 10/04/18
 * Time: 18:02
 */

namespace Controller;


class JobController extends AbstractController
{
    public function getAllJobs()
    {
        $jobManager = new JobManager();
        $jobs = $jobManager->selectAllOrderByThemeId();
        return $jobs;
    }

    public function addComment(int $id)
    {
        return $this->twig->render('comment.html.twig', ['jobId' => $id]);
    }

}