<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('library/EA/AutoLoader.php');
EA_AutoLoader::init(array(), 'library/');

# second node

$oAuth2 = new EA_Auth();
$oAuth2->setPassword('l33tl33t');

$oCheck2 = new EA_Check_Http_Request();
$oCheck2->setHost('www.google.de');
$oCheck2->setPort(80);
$oCheck2->setSsl(false);

$oRequest2 = new EA_Request();
$oRequest2->setAuth($oAuth2);
$oRequest2->setCheck($oCheck2);

# first node

$oAuth = new EA_Auth();
$oAuth->setPassword('l33t');

$oCheck = new EA_Check_Remote_Request();
$oCheck->setRemoteHost('192.168.2.108');
$oCheck->setRemotePort(9786);
$oCheck->setRequest($oRequest2);

$oRequest = new EA_Request();
$oRequest->setAuth($oAuth);
$oRequest->setCheck($oCheck);

$oSocketClient = new EA_Socket_Client('127.0.0.1', 9786, 5);
$sResponse = $oSocketClient->sendMessageAndGetResponse(serialize($oRequest));

$oResponse = unserialize($sResponse);

var_dump($oResponse);
