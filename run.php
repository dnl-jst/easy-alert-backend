<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('library/EA/AutoLoader.php');
EA_AutoLoader::init(array(), 'library/');

$requestHandler = new EA_RequestHandler();

$daemon = new EA_Socket_Daemon();
$daemon->setListener($requestHandler);
$daemon->setBindAddress('0.0.0.0');
$daemon->setBindPort(9786);
$daemon->setDebug(true);
$daemon->start();
