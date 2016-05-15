<?php

require_once '../../common/helpers/networkHelper.php';


class SmsHelper
{

	public function sendSms($smsAddress, $body)
	{
		// Making a HTTP Request to SMS_Endpoint as this is Simulation Environment
		$sendSmsResponse = NetworkHelper::postJson($smsAddress, $body, 2, 5);
		
		return "Sms Sent Successfully";
	}

}