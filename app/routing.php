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
    'Index' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
    ],
    'Job' => [
        ['addComment', '/job/comment/{id:\d+}', 'GET'],
    ],
    'Comment' => [
        ['addComment', '/comment/add', 'POST'],
    ],
];
