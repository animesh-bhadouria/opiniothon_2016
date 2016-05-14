<?php

$loc = dirname(__FILE__); 
$info = "$loc/delivery.info";
$handle = fopen($info, 'r');
$data = fread($handle,filesize($info));
return json_encode($data);
