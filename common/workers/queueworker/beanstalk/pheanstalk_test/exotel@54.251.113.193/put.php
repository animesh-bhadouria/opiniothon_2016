<?php
include 'vendor/autoload.php';
use Pheanstalk\Pheanstalk;
$pheanstalk = new Pheanstalk('127.0.0.1');

//$tube_id=rand(1,9);
//$r1=rand(1,10000000);
//$r2=rand(1,10000000);
$pheanstalk->useTube('july17A')->put('I must have appeared after 10 seconds delay.', 0, 5);

?>
