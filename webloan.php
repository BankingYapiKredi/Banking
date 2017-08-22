<?php 
	
	
        $rate = 5;
        $cards = array();
 //////////////////////////////////////////////////////////
		/*$db = new DB();
		
       
		$query = $db->getDataTable("SELECT Balance FROM card WHERE CardNO=$CardID");
////////////////////////////
		$cards = array();
			
       
            if ($rowBalance = $query->fetch_assoc()) {
                    
    			if ($rowBalance['Balance']>=$Amount) {
    				//acknowledge OK gönderilerecek
    			    //Balance Update Yapılacak kendi db mizde
    				array_push( $cards, array("Acknowledge"=>"TRUE") );
                    CardManager::updateBalance($CardID, ($rowBalance['Balance']-$Amount));
    			}
    			else {
    				//acknowledge Not OK gönderilerecek
    
    				array_push( $cards, array("Acknowledge"=>"FALSE") );
    			}
    		}
			else//öyle bir kart kullanıcısı yoksa
            {
                    array_push( $cards, array("Acknowledge"=>"NOCARD") );
            }
                    
        */
		array_push( $cards, array("rate"=>$rate) );
		header('content-type: application/json; charset=utf-8');
		header("access-control-allow-origin: *");
		echo json_encode($rate);

	

?>