<?php
include 'vendor/autoload.php';
use Pheanstalk\Pheanstalk;
$pheanstalk = new Pheanstalk('127.0.0.1');
while(true){
$job=$pheanstalk->watch('july17A')->ignore('default')->reserve();
if($job){
echo $job->getdata()."\n";
$pheanstalk->delete($job);
}
}

?>
