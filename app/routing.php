<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Index' => [
        ['index', '/', 'GET'],
    ],
    'Job' => [ // Controller
        ['showJobs', '/jobs', 'GET'], // action, url, method
        ['getOneJobById', '/job/{id}', 'GET'], // action, url, method
        ['updateJob', '/admin/update-job/{jobId:\d+}', ['POST','GET']], // action, url, method
    ],
    'Comment' => [ // Controller
        ['getComments', '/admin/comment', 'GET'], // action, url, method
        ['getComments', '/admin/comment/{pageId:\d+}', 'GET'], // action, url, method
        ['commentView', '/admin/comment-view/{id:\d+}', 'GET'], // action, url, method
        ['commentUpdate', '/admin/comment-update', 'POST'], // action, url, method
        ['addComment', '/job/{id:\d+}/add-comment', ['POST','GET']],
        ['loadComments', '/job/load-comment', 'POST'],
        ['addLike', '/like/{commentId:\d+}/{jobId:\d+}', 'GET' ],
    ],
    'Admin' => [
        ['showThemesAndJobs', '/admin/themes-jobs', 'GET'],
    ],
    'Theme' => [
        ['addTheme', '/admin/add-theme', 'POST'],
        ['updateTheme', '/admin/update-theme/{themeId:\d+}', ['POST','GET']],
        ['deleteTheme', '/admin/delete-theme', 'POST'],
    ],
];
