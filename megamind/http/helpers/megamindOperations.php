<?php

require_once "../../common/workers/queueworker/beanstalk/queueOperations.php";


class MegamindOperations
{
	public function switchRoleForMinion($minionId, $body) 
	{
		if(!empty($minionId)) {
			$queueServer = "127.0.0.1";
			$queueName = "freeMinionsInMegamind";
			MegamindOperations::addToMegamindMinionsPool($minionId, $queueServer, $queueName, $body);
			return true;
		} else {
			return false;
		}
	}


	public function addToMegamindMinionsPool($minionId, $queueServer, $queueName, $body) 
	{
		$QueueOperationsObj = new QueueOperations($queueServer, $queueName);
		$QueueOperationsObj->enqueue($body);

	}

	public function switchRoleForMerchant($merchantId, $body) 
	{
		if(!empty($merchantId)) {	
		    $queueServer = "127.0.0.1";
			$queueName = "jobsToAssignInMegamind";
			MegamindOperations::addToMegamindMerchantsPool($merchantId, $queueServer, $queueName, $body);
			return true;
		} else {
			return false;
		}
	}


	public function addToMegamindMerchantsPool($merchantId, $queueServer, $queueName, $body)
	{
		
		$QueueOperationsObj = new QueueOperations($queueServer, $queueName);
		$QueueOperationsObj->enqueue($body);


	} 

}