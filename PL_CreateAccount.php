<?php
	require_once("../BusinessLayer/BL_CreateAccountManager.php");
	require_once("../BusinessLayer/BL_LoginManager.php");
	session_start();
	if (isset($_POST["createAccount"])) {
		if(isset($_POST["TaxId"]) && isset($_POST["CompanyName"]) && isset($_POST["Email"]) && isset($_POST["PhoneNumber"]) && isset($_POST["Password"]) && isset($_POST["Address"])) {
			$TaxId = trim($_POST["TaxId"]);
			$CompanyName = trim($_POST["CompanyName"]);
			$Email = trim($_POST["Email"]);
			$PhoneNumber = trim($_POST["PhoneNumber"]);
			$Password = trim($_POST["Password"]);
			$Address = trim($_POST["Address"]);
			$result = BL_CreateAccountManager::InsertNewCompany($TaxId,$CompanyName,$Email,$PhoneNumber,$Password,$Address);
			if($result) {
				echo "success";
			}else{
				echo "dismiss";
			}
			$result = BL_LoginManager::getAllUsers($TaxId);
			$result2 = BL_LoginManager::GetFindAccountId($TaxId);
			$_SESSION['CompanyName']=$result[0]->getCompanyName();
			$_SESSION['AccountId']=$result2[0]->getAccountId();
			header("Location: ../PresentationLayer/PL_HomePage.php");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Account Page</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<div class="row">
	    	<div class="col-md-4"></div>
	    	<form method="post" action="#" role="login">
	            <div class="col-md-4">
	                <div class="form-group">
	                    <label for="InputName">Tax Id</label>
	                    <div class="input-group">
	                        <input type="text" style="width: 360px;" name="TaxId" placeholder="Tax Id" required class="form-control"/>
	                        <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="InputName">Company Name</label>
	                    <div class="input-group">
	                        <input type="text" style="width: 360px;" name="CompanyName" placeholder="Company Name" required class="form-control"/>
	                        <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="InputName">Email</label>
	                    <div class="input-group">
	                        <input type="text" style="width: 360px;" name="Email" placeholder="Email" required class="form-control"/>
	                        <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="InputName">Phone Number</label>
	                    <div class="input-group">
	                        <input type="text" style="width: 360px;" name="PhoneNumber" placeholder="Phone Number" required class="form-control"/>
	                        <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="InputName">Password</label>
	                    <div class="input-group">
	                        <input type="password" style="width: 360px;" name="Password" placeholder="Password" required class="form-control"/>
	                        <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="InputName">Address</label>
	                    <div class="input-group">
	                        <input type="text" style="width: 360px;" name="Address" placeholder="Address" required class="form-control"/>
	                        <!--<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
	                    </div>
	                </div>
	                <input type="submit" name="createAccount" value="Create Account" class="btn btn-info pull-left">
	                <button name="cancel" class="btn btn-info pull-right"><a href="PL_Login.php" style="text-decoration: none;color: white;">Cancel</a></button>
	            </div>
	        </form>
      	<div class="col-md-4"></div>
  	</div>
</body>
</html>