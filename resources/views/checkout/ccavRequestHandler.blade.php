
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title> HDFC CCAvenue checkout</title>
</head>
<body>
<center>
<?php

	function encrypt1($plainText,$key)
	{
		$key = hextobin1(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}


	function decrypt1($encryptedText,$key)
	{
		$key = hextobin1(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = hextobin1($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}

	function hextobin1($hexString) 
	{ 
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
		} 
		
		else 
		{
			$binString.=$packedString;
		} 
		
		$count+=2; 
	} 
		return $binString; 
	} 

?>

<?php 

	error_reporting(0);

	$working_key=env("CCAV_WORKING_KEY");//Shared by CCAVENUES
	$access_code=env("CCAV_ACCESS_CODE");//Shared by CCAVENUES
	$merchant_data='';
	
	foreach ($resp as $key => $value){	
		$merchant_data.=$key.'='.$value.'&';
	}
	
	$encrypted_data=encrypt1($merchant_data,$working_key); // Method for encrypting the data.

	$production_url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
?>

<!-- <iframe src="<?php echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>

<script src="{{URL::to('/')}}/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    	$(document).ready(function(){
    		 window.addEventListener('message', function(e) {
		    	 $("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
		 	 }, false);
	 	 	
		});
</script>
</center> -->

<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
	<?php
		echo "<input type=hidden name=encRequest value=$encrypted_data>";
		echo "<input type=hidden name=access_code value=$access_code>";
	?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

