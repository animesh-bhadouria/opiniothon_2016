<?php

require_once "../../common/workers/queueworker/beanstalk/queueOperations.php";
require_once '../../common/helpers/networkHelper.php';
require_once '../../common/helpers/SmsHelper.php';
require_once './config.php';



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


    public function getFromMegamindMinionsPool($queueServer, $queueName) 
    {
            $QueueOperationsObj = new QueueOperations($queueServer, $queueName);
            return $QueueOperationsObj->dequeue();

    }

    public function getFromMegamindMerchantsPool($queueServer, $queueName) 
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
            $minionUrl = $config['minion_http_url'];
            $minionSmsAddress = $config['minion_sms_address'];

            $currentTime = date("Y-m-d H:i:s");


            // Making a HeartBeat Request to Minion
            $minionResponse = NetworkHelper::postJson($minionUrl, $assignedJob , 1, 2);
            

            //if it fails, failover through SMS.
            if (empty($minionResponse)) {
                $smsStatus = SmsHelper::sendSms($minionSmsAddress, $assignedJob);
            } else {
                return $minionResponse;
            }
            return $smsStatus;

    }


}