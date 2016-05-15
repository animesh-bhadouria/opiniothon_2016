<?php


class IdResolver
{

	// public function to return details about a Merchant; Details fetched from local files using $merchantId as a search key.
	public function getMerchantBasedOnId($merchantId)
	{
		$filePath = dirname(__FILE__);
		$headersStringCmd = "head -n1 $filePath/../data/merchantData/merchantDetails.csv";
		$merchantIdStringCmd = "grep '^$merchantId' $filePath/../data/merchantData/merchantDetails.csv";

		$headersString = shell_exec($headersStringCmd);

		$merchantIdString = shell_exec($merchantIdStringCmd);

		$headers = str_replace(array("\n","\r"), '', $headersString);
		$merchantDetails = str_replace(array("\n","\r","\""), '', $merchantIdString);
        
        $keys = explode(',', $headers);
        $values = explode(',', $merchantDetails);

		$combined = array_combine($keys, $values);
		return json_encode($combined, JSON_PRETTY_PRINT);


	}


	// public function to return details about a Customer; Details fetched from local files using $customerId as a search key.
	public function getCustomerBasedOnId($customerId)
	{
		$filePath = dirname(__FILE__);
		$headersStringCmd = "head -n1 $filePath/../data/customerData/customerDetails.csv";
		$customerIdStringCmd = "grep '^$customerId' $filePath/../data/customerData/customerDetails.csv";

		$headersString = shell_exec($headersStringCmd);

		$customerIdString = shell_exec($customerIdStringCmd);

		$headers = str_replace(array("\n","\r"), '', $headersString);
		$customerDetails = str_replace(array("\n","\r","\""), '', $customerIdString);
        
        $keys = explode(',', $headers);
        $values = explode(',', $customerDetails);
		
		$combined = array_combine($keys, $values);
		return json_encode($combined, JSON_PRETTY_PRINT);

	}
	


	// public function to return details about a Minion; Details fetched from local files using $minionId as a search key.
	public function getMinionBasedOnId($minionId)
	{

		$filePath = dirname(__FILE__);
		$headersStringCmd = "head -n1 $filePath/../data/minionData/minionDetails.csv";
		$minionIdStringCmd = "grep '^$minionId' $filePath/../data/minionData/minionDetails.csv";

		$headersString = shell_exec($headersStringCmd);

		$minionIdString = shell_exec($minionIdStringCmd);

		$headers = str_replace(array("\n","\r"), '', $headersString);
		$minionDetails = str_replace(array("\n","\r","\""), '', $minionIdString);
        
        $keys = explode(',', $headers);
        $values = explode(',', $minionDetails);
		
		$combined = array_combine($keys, $values);
		return json_encode($combined, JSON_PRETTY_PRINT);
	}




}

 /*Uncomment below lines to test IdResolver

echo IdResolver::getMerchantBasedOnId("1");
echo IdResolver::getCustomerBasedOnId("1");
echo IdResolver::getMinionBasedOnId("1");

*/
