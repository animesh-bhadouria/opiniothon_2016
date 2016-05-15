<?php

include 'pheanstalk_client/vendor/autoload.php';
use Pheanstalk\Pheanstalk;

/* Class QueueOperation to interface with queue server running beanstalk.
 * Using pheanstalk php client for beanstalk.
 *  public functions enqueue() and dequeue() performs expected beanstalk operations
 *
 * author : raj
 *
 */

class QueueOperations 
{

    // $queueServer :: Stores url of queue hosting Server
    // $queueName :: Stores Name of the Queue
    // $pheanstalkObj :: Object of Pheanstalk_client to interact with beanstalk queue
    // $returnArr :: An array to be returned by dequeue function with dequeued messages


  public function __construct($queueServer, $queueName)
    {
        $this->queueServer = $queueServer;
        $this->queueName = $queueName;
        $this->pheanstalkObj = new Pheanstalk($this->queueServer);
        $this->returnArr = array();

    } //end of Class QueueOperations's constructor


    //enqueue function. Pass in string message to put in queue.
    public function enqueue($queueMsg)
    {
        $this->pheanstalkObj->useTube($this->queueName)->put($queueMsg);
        return "Enqueue Operation Successful";

    } //end of enqueue function


    //dequeue function. Pushes out (and delete) the first $numOfQueueMsgs message(s) from the queue
    public function dequeue($numOfQueueMsgs = 1)
    {  
        $counter = 1;

        while ($counter <= $numOfQueueMsgs) {
            $job = $this->pheanstalkObj->watch($this->queueName)->ignore('default')->reserve();
            if($job) {
                $thisMsg = $job->getdata()."\n";
                array_push($this->returnArr, $thisMsg);
                $this->pheanstalkObj->delete($job);
                $counter++;
            }
        }
        return $this->returnArr;


    } //end of dequeue function

}//end of class