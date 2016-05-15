<?php

require_once '../queueOperations.php';


/* File to test Queue Operations
 * Give correct $queueServer and $queueName values.
 * 
 * It enqueues 30 Messages then dequeues 
 * a. Single Message
 * b. 10 Messages
 * 
 * Finally, queue will have 19 new messages in Ready state.
 *
 * author : raj
 *
 */

$queueServer = "127.0.0.1";
$queueName = "opinio_test_queue1";

$queueOperationsObj = new QueueOperations($queueServer, $queueName);


// enqueue test
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
$enqueueResult = $queueOperationsObj->enqueue("Hey, This is Raj.");
echo "Enqueued messages successfully.\n\n";


// dequeue test. Get Single Message
$dequeueResult = $queueOperationsObj->dequeue();
echo "Dequeue Result : Single Message.\n";
var_dump($dequeueResult);


// dequeue test. Get 10 Messages
$dequeueResult = $queueOperationsObj->dequeue(10);
echo "\n\n DequeueResult : 10 Messages.\n";
var_dump($dequeueResult);


