<?php

include __DIR__ . '/../../vendor/autoload.php';

session_start();

require __DIR__ . '/../config/exceptions.php';


use App\Core\MongoClient;
MongoClient::initialize();


require __DIR__ . '/../config/twig.php';
require __DIR__ . '/../config/router.php';