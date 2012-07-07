<?php

/*
 * Copyright (c) 2012, Daniel Jost
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted/provided that the following conditions are met:
 *
 * - Redistributions of source code must retain the above copyright notice, this list
 *   of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice, this list
 *   of conditions and the following disclaimer in the documentation and/or other materials
 *   provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT
 * SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
 * TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR
 * BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
 * SUCH DAMAGE.
 */

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
