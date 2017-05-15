<?php
define( 'DS', DIRECTORY_SEPARATOR );
define( 'BASE_PATH', __DIR__ . DS );

$siteUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//include BASE_PATH . 'home.php';
include BASE_PATH . 'home.php';