<?php

require_once "../../common/workers/queueworker/beanstalk/queueOperations.php";
require_once "./oblivionOperations.php";




$merchantQueueServer = "172.31.98.139";
$merchantQueueName = "jobsToAssignInOblivion";
$unassignedJob = OblivionOperations::getFromOblivionPool($merchantQueueServer, $merchantQueueName);


$minionsQueueServer = "172.31.98.139";
$minionsQueueName = "freeMinionsInOblivion";
$freeMinion = OblivionOperations::getFromOblivionPool($minionsQueueServer, $minionsQueueName);




$jobAssigned = OblivionOperations::assignTaskToMinion($freeMinion, $unassignedJob);
// $bodyArr = json_decode($freeMinion, true);
if (!isset($freeMinion["minion_id"])) {
	$minionId = "2211";
} 


if ($jobAssigned) {
    OblivionOperations::notifyMinion($minionId, $jobAssigned);

} else {
	echo "Cannot assign Task $unassignedJob to $freeMinion .";
}

