<?php

$currentLoc = dirname(__FILE__);
define('APPPATH', "$currentLoc/../");
require(APPPATH . 'common/helpers/networkHelper.php'); 

$info = "$currentLoc/min.info";
$handle = fopen($info, 'r');
$postData = fread($handle,filesize($info));

$url = '<obvilion_url>/score';
networkHelper::postJson($url, $postData);
