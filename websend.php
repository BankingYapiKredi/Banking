
<?php 
    require_once("../BusinessLayer/BL_WebManager.php");
    require_once("../BusinessLayer/BL_CreateAccountManager.php");

     $result = BL_WebManager::SelectNewdata();//UpdateAccount

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!--<button id="btn">Click</button>-->
	<div id="contentType"></div>
	<script type="text/javascript" src="jquery-1.12.3.min.js"></script>	
	<script type="text/javascript">
$(document).ready(function() {
	//alert("asd");
	//$('#btn').click(function(){
		/*var that = $(this),
		contents=that.serialize();*/
		var cardid='<?php echo $result[0]->getCardId(); ?>';
		var accountid='<?php echo $result[0]->getAccountId(); ?>';
		var amount='<?php echo $result[0]->getAmount(); ?>';
		var info='<?php echo $result[0]->getInformation(); ?>';
		var url;
		if (cardid.substring(0,1) == "1") {
			url = "http://192.168.1.20:90/creditcardsystem/LogicLayer/webbalance.php";

		}else if (cardid.substring(0,1) == "2") {
			url = "http://192.168.43.93:90/BankProjectPHP/PresentationLayer/web.php";
		}

		$.ajax({
			url:url,
			dataType:"json",
			type:"post",
			data: {
				"webCardId" : cardid,
				"webAccountId" : accountid,
				"webAmount" : amount,
				"webInfo" : info
			},
			success:function(data){
				//console.log(data);
				var jsonobj=JSON.stringify(data);
								//alert(jsonobj);
				var obj = $.parseJSON(jsonobj);
				var ack=obj.cards[0].Acknowledge;
				if (ack == "TRUE") {
					$('#contentType').html(ack);
					"<?php
					 	$resultGet = $result[0]->getCardId();
					 	$resultUpdate = substr($resultGet,0,1);
					 	if ($resultUpdate == "1") {
							$updateAccount = BL_CreateAccountManager::WebServiceUpdateBalance($result[0]->getAccountId(),$result[0]->getAmount());
							/*header('Content-Type: application/json');
							echo json_encode(array('foo' => 'bar'));*/
					 	}
						
					?>"
				}
				else if(ack == "NOCARD"){
					//alert("no card");
					//$('#contentType').html(ack);
				}else if(ack == "NOBALANCE"){
					//alert("NOBALANCE");
					//$('#contentType').html(ack);
				}else{
					//alert("web service hatası");
					//$('#contentType').html(ack);
				}

				//alert(ack);
				//truysa weri tabanına kaydet
				//http://us2.php.net/manuel/en/ref.curl.php

			},
			error:function(err){
				//alert("error"+err);
			}
		});
		return false;
	//});
});
</script>
</body>
</html>