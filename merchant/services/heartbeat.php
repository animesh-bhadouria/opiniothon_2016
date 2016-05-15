<?php
require_once '../../common/helpers/networkHelper.php';
require_once '../../common/helpers/fileHelper.php';
require_once '../../common/helpers/SmsHelper.php';
require_once './config.php';

$filePath = "../merchant.info";

$megamindUrl = $config['megamind_http_url'];
$oblivionUrl = $config['oblivion_http_url'];

$megamindSmsAddress = $config['megamind_sms_address'];
$oblivionSmsAddress = $config['oblivion_sms_address'];

$currentTime = date("Y-m-d H:i:s");


$fileData = FileHelper::readFile($filePath);

$httpAvail = $config['httpStat'];
if($httpAvail) {
    // Making a HeartBeat Request to MegaMind
    $megamindResponse = NetworkHelper::postJson($megamindUrl, $fileData , 1, 2);
} else {
    $megamindResponse = "";
}

if (!empty($megamindResponse)) {
    echo "megamindResponse :: $megamindResponse \n";
    $shellResult = shell_exec("echo '$currentTime,success' >> megamindConnectionHttp.log");

} else {
    echo "HeartBeat request to MegaMind Failed \n";
    $shellResult1 = shell_exec("echo '$currentTime,failed' >> megamindConnectionHttp.log");

    // if its the 5th consecutive failed request, notify megamind using SMS
    $shellResult2 = shell_exec("tail -n5 megamindConnectionHttp.log |  grep failed | wc -l");
    $shellResult2 = str_replace(array("\n","\r"), '', $shellResult2);
    if ($shellResult2 >= 5) {
        $megamindResponseSms = SmsHelper::sendSms($megamindSmsAddress, $fileData);
        $shellResult3 = shell_exec("echo '$currentTime,success' >> megamindConnectionSms.log");
    }

}

if($httpAvail) {
    // Making a HeartBeat Request to oblivion
    $oblivionResponse = NetworkHelper::postJson($oblivionUrl, $fileData , 1, 2);
} else {
    $oblivionResponse = "";
}

if (!empty($oblivionResponse)) {
    echo "oblivionResponse :: $oblivionResponse \n";
    $shellResult = shell_exec("echo '$currentTime,success' >> oblivionConnectionHttp.log");


} else {
    echo "HeartBeat request to oblivion Failed \n";
    $shellResult = shell_exec("echo '$currentTime,failed' >> oblivionConnectionHttp.log");

    // if its the 5th consecutive failed request, notify megamind using SMS
    $shellResult2 = shell_exec("tail -n5 oblivionConnectionHttp.log |  grep failed | wc -l");
    $shellResult2 = str_replace(array("\n","\r"), '', $shellResult2);
    if ($shellResult2 >= 5) {
        $oblivionResponseSms = SmsHelper::sendSms($megamindSmsAddress, $fileData);
        $shellResult3 = shell_exec("echo '$currentTime,success' >> oblivionConnectionSms.log");
    }

}
?>
