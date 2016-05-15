<?php
require_once '../../common/helpers/networkHelper.php';
require_once '../../common/helpers/fileHelper.php';
require_once '../../common/helpers/SmsHelper.php';
require_once './config.php';

$filePath = "../min.info";

$minionUrl = $config['minion_http_url'];
$oblivionUrl = $config['oblivion_http_url'];

$minionSmsAddress = $config['minion_sms_address'];

$currentTime = date("Y-m-d H:i:s");


$fileData = FileHelper::readFile($filePath);

// Making a HeartBeat Request to Minion
$minionResponse = NetworkHelper::postJson($minionUrl, $fileData , 1, 2);

if (!empty($minionResponse)) {
    echo "minionResponse :: $minionResponse \n";
    $shellResult = shell_exec("echo '$currentTime,success' >> minionConnectionHttp.log");

} else {
    echo "HeartBeat request to minion Failed \n";
    $shellResult1 = shell_exec("echo '$currentTime,failed' >> minionConnectionHttp.log");

    // if its the 5th consecutive failed request, notify megamind using SMS
    $shellResult2 = shell_exec("tail -n5 minionConnectionHttp.log |  grep failed | wc -l");
    $shellResult2 = str_replace(array("\n","\r"), '', $shellResult2);
    if ($shellResult2 >= 5) {
        $minionResponseSms = SmsHelper::sendSms($minionSmsAddress, $fileData);
        $shellResult3 = shell_exec("echo '$currentTime,success' >> minionConnectionSms.log");
    }

}


// Making a HeartBeat Request to oblivion
$oblivionResponse = NetworkHelper::postJson($oblivionUrl, $fileData , 1, 2);

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
        $oblivionResponseSms = SmsHelper::sendSms($oblivionSmsAddress, $fileData);
        $shellResult3 = shell_exec("echo '$currentTime,success' >> oblivionConnectionSms.log");
    }

}
