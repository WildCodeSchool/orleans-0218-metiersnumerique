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
    'Comment' => [ // Controller
        ['getComment', '/admin/comment', 'GET'], // action, url, method
        ['commentView', '/admin/comment-view/{id:\d+}', 'GET'], // action, url, method
    ],
];
