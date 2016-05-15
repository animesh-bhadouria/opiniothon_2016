<?php
require_once "../services/megamindOperations.php";

// $smsBody = file_get_contents('php://input');

$smsBody = '{
				"minion_id":"2211",
				"minion_status":"busy",
				"minion_phno":"9840401776",
				"minion_lat":"12.9716",
				"minion_long":"77.5946"
				}';


$smsBody1 = '{
				"delivery_id":"ee769100506340b7aa39f9f5a0c63d0b",
				"merchant_id":"2211",
				"customer_id":"12",
				"time_created":"2016-05-15 00:30:48"

				}';

$bodyArr = json_decode($smsBody, true);


if (isset($bodyArr["minion_id"])) {

	$minionId = $bodyArr["minion_id"];
	// echo "minionId :: $minionId \n\n";


	$currentTime = date("Y-m-d H:i:s");

	$shellResult1 = shell_exec("echo '$currentTime,$minionId' >> minionsSms.log");



	$fifthLastFailureTime = shell_exec("grep $minionId minionsSms.log | tail -n5 | head -n1 | cut -d, -f1");
	$fifthLastFailureTime = str_replace(array("\n","\r"), '', $fifthLastFailureTime);

	$thisFailureTime = shell_exec("grep $minionId minionsSms.log | tail -n1 | cut -d, -f1");
	$thisFailureTime = str_replace(array("\n","\r"), '', $thisFailureTime);

	$from_time = strtotime($fifthLastFailureTime);
	$to_time = strtotime($thisFailureTime);
echo round(abs($to_time - $from_time));
	if (round(abs($to_time - $from_time)) < 10 && round(abs($to_time - $from_time)) < 300) {
		MegamindOperations::switchRoleForMinion($minionId, $smsBody);
	}

} else {
	$merchantId = $bodyArr["merchant_id"];
	echo "merchantId :: $merchantId \n\n";


	$currentTime = date("Y-m-d H:i:s");

	$shellResult1 = shell_exec("echo '$currentTime,$merchantId' >> merchantSms.log");



	$fifthLastFailureTime = shell_exec("grep $merchantId merchantSms.log | tail -n5 | head -n1 | cut -d, -f1");
	$fifthLastFailureTime = str_replace(array("\n","\r"), '', $fifthLastFailureTime);

	$thisFailureTime = shell_exec("grep $merchantId merchantSms.log | tail -n1 | cut -d, -f1");
	$thisFailureTime = str_replace(array("\n","\r"), '', $thisFailureTime);



	$from_time = strtotime($fifthLastFailureTime);
	$to_time = strtotime($thisFailureTime);
    echo round(abs($to_time - $from_time));
	
	if (round(abs($to_time - $from_time)) > 10 && round(abs($to_time - $from_time)) < 300) {
		MegamindOperations::switchRoleForMerchant($merchantId, $smsBody);
	}
}



