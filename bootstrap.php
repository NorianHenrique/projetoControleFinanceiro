<?php

session_start();
require ('vendor/autoload.php');
require('config/config.inc.php');



$config = ['settings' => [
        'displayErrorDetails' => true
    ]
];

$app = new \Slim\App($config);

require('routes/web.php');

$app->run();