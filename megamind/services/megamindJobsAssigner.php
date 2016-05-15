<?php

require_once "../../common/workers/queueworker/beanstalk/queueOperations.php";
require_once "./megamindOperations.php";




$merchantQueueServer = "172.31.99.15";
$merchantQueueName = "jobsToAssignInMegamind";
$unassignedJob = MegamindOperations::getFromMegamindPool($merchantQueueServer, $merchantQueueName);


$minionsQueueServer = "172.31.99.15";
$minionsQueueName = "freeMinionsInMegamind";
$freeMinion = MegamindOperations::getFromMegamindPool($minionsQueueServer, $minionsQueueName);




$jobAssigned = MegamindOperations::assignTaskToMinion($freeMinion, $unassignedJob);
// $bodyArr = json_decode($freeMinion, true);
if (!isset($freeMinion["minion_id"])) {
	$minionId = "2211";
} 


if ($jobAssigned) {
    MegamindOperations::notifyMinion($minionId, $jobAssigned);

} else {
	echo "Cannot assign Task $unassignedJob to $freeMinion .";
}

