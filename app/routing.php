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
    ],
    'Comment' => [
        ['addComment', '/job/{id:\d+}/add-comment', ['POST','GET']],
    ],
    'Comment' => [ // Controller
        ['getCommentWithJobName', '/admin/comment', 'GET'], // action, url, method
        ['commentView', '/admin/comment-view/{id:\d+}', 'GET'], // action, url, method
    ],
];
