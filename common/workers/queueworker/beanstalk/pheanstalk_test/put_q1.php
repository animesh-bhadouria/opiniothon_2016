<?php
include 'vendor/autoload.php';
use Pheanstalk\Pheanstalk;
$pheanstalk = new Pheanstalk('54.201.215.21');


//$tube_id=rand(1,9);
//$r1=rand(1,10000000);
//$r2=rand(1,10000000);
$pheanstalk->useTube('Feb29')->put('I must have appeared after 10 seconds delay.');

?>
