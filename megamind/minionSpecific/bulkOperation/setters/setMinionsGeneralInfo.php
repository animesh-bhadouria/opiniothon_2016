<?php

$rooturl = dirname( __FILE__,5);

require_once $rooturl . '/common/helpers/fileHelper.php';

$jsonurl = $rooturl . "/minion/min.info";


$data = FileHelper::writeFile($jsonurl,true);








?>