<?php

$rooturl = dirname( __FILE__,5);


require_once $rooturl . '/common/helpers/fileHelper.php';

$jsonurl = $rooturl . "/minion/delivery.info";


$data = FileHelper::readFile($jsonurl,true);








?>