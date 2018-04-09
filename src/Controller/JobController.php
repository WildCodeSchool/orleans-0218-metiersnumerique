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

class JobController
{
    public function getAllJobs()
    {
        $jobManager = new JobManager();
        $jobs = $jobManager->selectAllOrderByThemeId();

        return $jobs;
    }
}