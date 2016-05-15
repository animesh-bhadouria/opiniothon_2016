<?php

require_once "../../common/workers/queueworker/beanstalk/queueOperations.php";
require_once '../../common/helpers/networkHelper.php';
require_once '../../common/helpers/SmsHelper.php';
$curDir = dirname(__FILE__);
require_once "$curDir/config.php";


class OblivionOperations
{
    public function switchRoleForMinion($minionId, $body) 
    {
        if(!empty($minionId)) {
            $queueServer = "172.31.98.139";
            $queueName = "freeMinionsInOblivion";
            OblivionOperations::addToOblivionMinionsPool($minionId, $queueServer, $queueName, $body);
            return true;
        } else {
            return false;
        }
    }


    public function addToOblivionMinionsPool($minionId, $queueServer, $queueName, $body) 
    {
        $QueueOperationsObj = new QueueOperations($queueServer, $queueName);
        $QueueOperationsObj->enqueue($body);

    }

    public function switchRoleForMerchant($merchantId, $body) 
    {
        if(!empty($merchantId)) {   
            $queueServer = "172.31.98.139";
            $queueName = "jobsToAssignInOblivion";
            OblivionOperations::addToOblivionMerchantsPool($merchantId, $queueServer, $queueName, $body);
            return true;
        } else {
            return false;
        }
    }


    public function addToOblivionMerchantsPool($merchantId, $queueServer, $queueName, $body)
    {
        
        $QueueOperationsObj = new QueueOperations($queueServer, $queueName);
        $QueueOperationsObj->enqueue($body);


    } 


    public function getFromOblivionMinionsPool($queueServer, $queueName) 
    {
            $QueueOperationsObj = new QueueOperations($queueServer, $queueName);
            return $QueueOperationsObj->dequeue();

    }

    public function getFromOblivionMerchantsPool($queueServer, $queueName) 
    {
            $QueueOperationsObj = new QueueOperations($queueServer, $queueName);
            return $QueueOperationsObj->dequeue();

    }

    public function getFromOblivionPool($queueServer, $queueName) 
    {
            $QueueOperationsObj = new QueueOperations($queueServer, $queueName);
            return $QueueOperationsObj->dequeue();

    }


    public function assignTaskToMinion($freeMinion, $unassignedJob) 
    {
            // validation logic can go in here.
            // Not getting into routing/scheduling problem for now.
            return true;

    }

    public function notifyMinion($minionId, $assignedJob) 
    {
            if (!isset($config['minion_http_url'])) {
                $minionUrl = "172.31.99.130/minion/assign.php";
            } 


            if (!isset($config['minion_sms_address'])) {
                $minion_sms_address = "172.31.99.130/sms";
            } 

            $currentTime = date("Y-m-d H:i:s");


            // Making a HeartBeat Request to Minion
            $minionResponse = NetworkHelper::postJson($minionUrl, $assignedJob , 1, 2);
            

            //if it fails, failover through SMS.
            if (empty($minionResponse)) {
                $smsStatus = SmsHelper::sendSms($minionUrl, $assignedJob);
            } else {
                return $minionResponse;
            }
            return $smsStatus;

    }


}