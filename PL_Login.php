<?php 
	require_once("../BusinessLayer/BL_LoginManager.php");
	session_start();
	$errorMeesage = "";
	if (isset($_POST["signIn"])) {
		if(isset($_POST["TaxId"]) && isset($_POST["Password"])) {
			$TaxId = trim($_POST["TaxId"]);
			$Password = trim($_POST["Password"]);
			$errorMeesage = "";
			$result = BL_LoginManager::getAllUsers($TaxId);
			if ($TaxId=="Admin" && $Password == 1111) {
				$_SESSION['CompanyName']="Admin";
				$_SESSION['AccountId']=1111;
				header("Location: ../PresentationLayer/PL_AdminHomePage.php");
			}else{
				if($result) {
					if ($Password == $result[0]->getPassword()) {
						$_SESSION['CompanyName']=$result[0]->getCompanyName();
						$_SESSION['AccountId']=$result[0]->getTaxId();
						header("Location: ../PresentationLayer/PL_HomePage.php");
					}else{
						echo "Wrong account id or password";
					}
				}else{
					echo "Wrong account id or password";
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top: 200px;">
		<div class="row">
	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	      		<section class="login-form">
	        		<form method="post" action="#" role="login">
	          			<h1 style="text-align: center;">Online Bank</h1>
	          			<input type="text" name="TaxId" placeholder="Tax Id" required class="form-control input-lg"/> 
	          			<input type="password" class="form-control input-lg" name="Password" placeholder="Password" required="" />
	          			<div class="pwstrength_viewport_progress"></div>
	          			<button type="submit" name="signIn" class="btn btn-lg btn-primary btn-block">Sign in</button>
	          			<div style="text-align: center;">
	            			<a href="PL_CreateAccount.php">Create Account</a> or <a href="PL_ResetPassword.php">Reset Password</a>
	          			</div> 
	        		</form>
	      		</section>  
	      	</div>
      	<div class="col-md-4"></div>
  	</div>
</body>
</html>