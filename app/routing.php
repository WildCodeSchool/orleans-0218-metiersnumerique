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
        ['getOneJobById', '/job/{id}', 'GET'], // action, url, method
    ],
    'Comment' => [
        ['addComment', '/job/{id:\d+}/add-comment', ['POST','GET']],
    ],
];
