<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('library/EA/AutoLoader.php');
EA_AutoLoader::init(array(), 'library/');

$oCheck = new EA_Check_Http();
$oCheck->setHost('www.google.de');
$oCheck->setPort(80);
$oCheck->setSsl(false);

$oRequest = new EA_Request();
$oRequest->setCheck($oCheck);

$oSocketClient = new EA_Socket_Client('127.0.0.1', 9786, 5);
$sResponse = $oSocketClient->sendMessageAndGetResponse(serialize($oRequest));

$oResponse = unserialize($sResponse);

var_dump($oResponse);
