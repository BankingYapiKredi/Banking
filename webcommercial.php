<?php 
	require_once("../BusinessLayer/BL_WebManager.php");
	require_once("../BusinessLayer/BL_CreateAccountManager.php");
	if(isset($_POST['webCardId']) && isset($_POST['webAccountId']) && isset($_POST['webAmount']) && isset($_POST['webInfo'])) {
		
      
		
		$CardID=$_POST['webCardId'];
		$AccountId=$_POST['webAccountId'];
		$Amount=$_POST['webAmount'];
	    $Info=$_POST['webInfo'];
		
		$cards = array();
        
        //array_push( $cards, array("Acknowledge"=>"OK") );

        $result = BL_WebManager::InsertNewData($CardID,$AccountId,$Amount,$Info);

        $validateAccountId = BL_WebManager::ValidationAccountId($AccountId);

        $data = array(
				'webCardId'=>"$CardID",
				'webAccountId'=>"$AccountId",
				'webAmount'=>"$Amount",
			    'webInfo'=>"$Info"
		);
        


        if (!empty($validateAccountId)) {
			
			if (substr($CardID,0,1) == "1") {
			$updateAccount = BL_CreateAccountManager::WebServiceUpdateBalance($AccountId,$Amount);
			$url_target = "http://192.168.1.20:90/creditcardsystem/LogicLayer/webbalance.php";
			$curl = curl_init($url_target);
		
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		  	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			
			$result = curl_exec($curl);

			header('content-type: application/json; charset=utf-8');
			header("access-control-allow-origin: *");
			//echo json_encode(array('cards'=>$cards));
			echo json_encode($result);
			curl_close($curl);
			//array_push( $cards, array("Acknowledge"=>"OK") );

			}else if (substr($CardID,0,1) == "2") {
				$updateAccount = BL_CreateAccountManager::WebServiceUpdateBalance($AccountId,$Amount);
				$url_target = "http://192.168.1.27:90/BankProjectPHP/PresentationLayer/web.php";
				$curl = curl_init($url_target);
		
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			  	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				
				$result = curl_exec($curl);
				header('content-type: application/json; charset=utf-8');
				header("access-control-allow-origin: *");
						//echo json_encode(array('cards'=>$cards));
				echo json_encode($result);
				curl_close($curl);
				
				//array_push( $cards, array("Acknowledge"=>"OK") );
			}
			else{
			
				array_push( $cards, array("Acknowledge"=>"NOCARD") );
				header('content-type: application/json; charset=utf-8');
				header("access-control-allow-origin: *");
				
				echo json_encode(array('cards'=>$cards));
			}
		}else{
			
			array_push( $cards, array("Acknowledge"=>"NOACCOUNTID") );
			header('content-type: application/json; charset=utf-8');
			header("access-control-allow-origin: *");
			
			echo json_encode(array('cards'=>$cards));
		}


       //http://localhost:90/ntier3/PresentationLayer/web.php
 //////////////////////////////////////////////////////////
		/*$db = new DB();
		
       
		$query = $db->getDataTable("SELECT Balance FROM card WHERE CardNO=$CardID");
////////////////////////////
		$cards = array();
			
       
            if ($rowBalance = $query->fetch_assoc()) {
                    
    			if ($rowBalance['Balance']>=$Amount) {
    				//acknowledge OK gönderilerecek
    			    //Balance Update Yapilacak kendi db mizde
    				array_push( $cards, array("Acknowledge"=>"TRUE") );
                    CardManager::updateBalance($CardID, ($rowBalance['Balance']-$Amount));
    			}
    			else {
    				//acknowledge Not OK gönderilerecek
    
    				array_push( $cards, array("Acknowledge"=>"FALSE") );
    			}
    		}
			else//öyle bir kart kullanicisi yoksa
            {
                    array_push( $cards, array("Acknowledge"=>"NOCARD") );
            }
                    
        */
		/*echo "<!DOCTYPE html><html> <script type=\"text/javascript\" src=\"jquery-1.12.3.min.js\"></script>	
	<script type=\"text/javascript\">
	$(document).ready(function() {
		//alert(\"asd\");
		$('#btn').click(function(){

			var cardid='<?php echo $result[0]->getCardId(); ?>';
			var accountid='<?php echo $result[0]->getAccountId(); ?>';
			var amount='<?php echo $result[0]->getAmount(); ?>';
			var info='<?php echo $result[0]->getInformation(); ?>';

			$.ajax({
				url:\"http://192.168.43.115:80/test/userlist.php\",
				dataType:\"json\",
				type:\"post\",
				data: {
					\"webCardId\" : cardid,
					\"webAccountId\" : accountid,
					\"webAmount\" : amount,
					\"webInfo\" : info
				},
				success:function(data){

					console.log(data);
					var jsonobj=JSON.stringify(data);
									//alert(jsonobj);
					var obj = $.parseJSON(jsonobj);
					var ack=obj.cards[0].Acknowledge;
					//alert(ack);
					//truysa weri tabanina kaydet
					
				},
				error:function(err){

					//alert(\"error\"+err);
				}
			});
			return false;
		});
});
</script> </html>";*/


		
	}
?>
