<?php

error_reporting(0);
if(isset($_GET['oid'])){
	error_reporting(0);
	$working_key = env('CCAV_WORKING_KEY'); //Shared by CCAVENUES
	$access_code = env('CCAV_ACCESS_CODE');

	$merchant_json_data =
		array(
		'order_no' => $_GET['oid'],
		'reference_no' =>''
	);

	$merchant_data = json_encode($merchant_json_data);

	$hexString=md5($working_key);
	$length = strlen($hexString); 
	$binString="";   
	$count=0; 
	while($count<$length) 
	{       
		$subString =substr($hexString,$count,2);           
		$packedString = pack("H*",$subString); 
		if ($count==0)
		{
			$binString=$packedString;
		}else 
		{
			$binString.=$packedString;
		} 
		$count+=2; 
	} 

	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$openMode = openssl_encrypt($merchant_data, 'AES-128-CBC', $binString, OPENSSL_RAW_DATA, $initVector);

	$encrypted_data = bin2hex($openMode);


	$final_data = 'enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=orderStatusTracker&request_type=JSON&response_type=JSON';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://apitest.ccavenue.com/apis/servlet/DoWebTrans");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/json') ;
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
	// Get server response ...
	$result = curl_exec($ch);
	curl_close($ch);
	$status = '';
	$information = explode('&', $result);

	$dataSize = sizeof($information);
	for ($i = 0; $i < $dataSize; $i++) {
		$info_value = explode('=', $information[$i]);
		if ($info_value[0] == 'enc_response') {

			$encryptedText=trim($info_value[1]);

			$hexString=md5($working_key);
			$length = strlen($hexString); 
			$binString="";   
			$count=0; 
			while($count<$length) 
			{       
				$subString =substr($hexString,$count,2);           
				$packedString = pack("H*",$subString); 
				if ($count==0)
				{
					$binString=$packedString;
				}else 
				{
					$binString.=$packedString;
				} 
				$count+=2; 
			} 
			// $result = $binString;

			$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);

			$hexString=$encryptedText;
			$length = strlen($hexString); 
			$binString2="";   
			$count=0; 
			while($count<$length) 
			{       
				$subString =substr($hexString,$count,2);           
				$packedString = pack("H*",$subString); 
				if ($count==0)
				{
					$binString2=$packedString;
				}else 
				{
					$binString2.=$packedString;
				} 
				$count+=2; 
			} 
			// $result = $binString2;

			$decryptedText = openssl_decrypt($binString2, 'AES-128-CBC', $binString, OPENSSL_RAW_DATA, $initVector);
			$status=$decryptedText;
		}
	}

	echo '<pre>';
	$obj = json_decode($status);
	print_r($obj);

	error_reporting(0);

}
else{
	echo '<pre>Order not found</pre>';
}


?>