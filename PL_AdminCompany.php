<?php
  session_start();
  require_once("../BusinessLayer/BL_LoginManager.php");
  require_once("../BusinessLayer/BL_CreateAccountManager.php");
  
  if(isset($_POST["logout"])) {
    unset($_SESSION['CompanyName']);
    unset($_SESSION['AccountId']);
    header("Location:../PresentationLayer/PL_Login.php");
  }
  if (isset($_POST["createAccount"])) {
    if(isset($_POST["TaxId"]) && isset($_POST["CompanyName"]) && isset($_POST["Email"]) && isset($_POST["PhoneNumber"]) && isset($_POST["Password"]) && isset($_POST["Address"])) {
      $TaxId = trim($_POST["TaxId"]);
      $CompanyName = trim($_POST["CompanyName"]);
      $Email = trim($_POST["Email"]);
      $PhoneNumber = trim($_POST["PhoneNumber"]);
      $Password = trim($_POST["Password"]);
      $Address = trim($_POST["Address"]);
      $result = BL_CreateAccountManager::InsertNewCompany($TaxId,$CompanyName,$Email,$PhoneNumber,$Password,$Address);
    }
  }
  if (isset($_POST["updateAccount"])) {
    if(isset($_POST["SelectedUpdateOption"]) && isset($_POST["UpdateCompanyName"]) && isset($_POST["UpdateEmail"]) && isset($_POST["UpdatePhoneNumber"]) && isset($_POST["UpdatePassword"]) && isset($_POST["UpdateAddress"])) {
      $TaxId = trim($_SESSION['TaxId']);
      $CompanyName = trim($_POST["UpdateCompanyName"]);
      $Email = trim($_POST["UpdateEmail"]);
      $PhoneNumber = trim($_POST["UpdatePhoneNumber"]);
      $Password = trim($_POST["UpdatePassword"]);
      $Address = trim($_POST["UpdateAddress"]);
      $result = BL_CreateAccountManager::UpdateCompany($TaxId,$CompanyName,$Email,$PhoneNumber,$Password,$Address);
    }
  }
  if (isset($_POST["deleteAccount"])) {
    if(isset($_POST["SelectedDeleteOption"])) {
      $TaxId = trim($_POST["SelectedDeleteOption"]);
      $result = BL_CreateAccountManager::DeleteCompany($TaxId);
    }
  }                                 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Admin Home Page</title>
    <script src="libs/bootstrap/js/jquery.js"></script>
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->    
    <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="libs/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="libs/bootstrap/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="libs/bootstrap/css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="libs/bootstrap/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="libs/bootstrap/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="libs/bootstrap/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="libs/bootstrap/css/owl.carousel.css" type="text/css">
  <link href="libs/bootstrap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
  <link rel="stylesheet" href="libs/bootstrap/css/fullcalendar.css">
  <link href="libs/bootstrap/css/widgets.css" rel="stylesheet">
    <link href="libs/bootstrap/css/style.css" rel="stylesheet">
    <link href="libs/bootstrap/css/style-responsive.css" rel="stylesheet" />
  <link href="libs/bootstrap/css/xcharts.min.css" rel=" stylesheet">  
  <link href="libs/bootstrap/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  </head>
  <body>
  <section id="container" class="">
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>
            <a href="#" class="logo">Online <span class="lite">Bank</span></a>
            <div class="top-nav notification-row">
                <ul class="nav pull-right top-menu">
                    <li id="task_notificatoin_bar" class="dropdown"><!-- notificatoin -->
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="icon-task-l"></i>
                            <span class="badge bg-important"></span>
                        </a>
                    </li>
                    <li id="mail_notificatoin_bar" class="dropdown"><!-- mesaj icon-->
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-envelope-l"></i>
                            <span class="badge bg-important"></span>
                        </a>
                    </li>
                    <li id="alert_notificatoin_bar" class="dropdown"><!-- alert notification-->
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-bell-l"></i>
                            <span class="badge bg-important"></span>
                        </a>
                    </li>
                    <li class="dropdown"><!-- user login dropdown start-->
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="libs/bootstrap/img/icon_user.png">
                            </span>
                            <span class="username"><?php echo $_SESSION['CompanyName'];?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="#"><i class="icon_profile"></i> Settings</a>
                            </li>
                            <li>
                              <form method="post" action="#">
                                <a href="PL_Login.php" name="logout"><i class="icon_key_alt"></i> Log Out</a>
                              </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
      </header>      
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu">                
                  <li class="active">
                      <a class="" href="#">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="PL_AdminCompany.php" class="">
                          <i class="icon_document_alt"></i>
                          <span>Company</span>
                      </a>
                  </li>       
                  <li class="sub-menu">
                      <a href="PL_AdminCreateAccount.php" class="">
                          <i class="icon_desktop"></i>
                          <span>Account</span>
                      </a>
                  </li>
                  <li>
                      <a class="" href="PL_AdminCreditCard.php">
                          <i class="icon_genius"></i>
                          <span>Credit Card</span>
                      </a>
                  </li>                
              </ul>
          </div>
      </aside>
      <div class="container">
        <div class="panel-group" id="accordion" style="margin-top: 150px;margin-left: 150px;width: 1000px;">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Update Company</a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
              <div class="panel-body">
                <form method="post" action="#" role="login">
                  <div class="col-md-4" >
                      <div class="form-group">
                          <label for="InputName">Tax Id</label>
                          <div class="input-group">
                              <select class="form-control" id="SelectedUpdateOption" name="SelectedUpdateOption">
                                <option>Select</option>
                                <?php 
                                  $userList = BL_LoginManager::getAllCompanies();
                                  for($i = 0; $i < count($userList); $i++) {
                                  ?>
                                    <option><?php echo $userList[$i]->getTaxId(); ?></option>
                                  <?php
                                  }
                                ?>
                                <input type="submit" name="changevalue" id="ChangeValue" value="Selected" />
                              </select>
                          </div>         
                      </div> 
                      <?php 
                        if(isset($_POST['changevalue'])){
                          $selected_val = $_POST['SelectedUpdateOption'];  // Storing Selected Value In Variable
                          $userList = BL_LoginManager::getAllUsers($selected_val);
                          $_SESSION['TaxId']=$userList[0]->getTaxId();
                         }
                        ?>
                      <div class="form-group">
                          <label for="InputName">Company Name</label>
                          <div class="input-group">
                            <input type="text" style="width: 360px;" name="UpdateCompanyName" value="<?php 
                            if(isset($_POST['changevalue'])){
                              echo $userList[0]->getCompanyName();
                              }
                              else {
                               echo null;
                              }
                             ?>" placeholder="Company Name" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Email</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" name="UpdateEmail" value="<?php 
                                if(isset($_POST['changevalue'])){
                              echo $userList[0]->getEmail();
                              }
                              else {
                               echo null;
                              }
                               ?>" placeholder="Email" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Phone Number</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" name="UpdatePhoneNumber" value="<?php 
                              if(isset($_POST['changevalue'])){
                              echo $userList[0]->getPhoneNumber();
                              }
                              else {
                               echo null;
                              }
                               ?>" placeholder="Phone Number" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Password</label>
                          <div class="input-group">
                              <input type="password" style="width: 360px;" name="UpdatePassword" value="<?php 
                              if(isset($_POST['changevalue'])){
                               echo $userList[0]->getPassword();
                              }
                              else {
                               echo null;
                              }
                               ?>" placeholder="Password" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Address</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" name="UpdateAddress" value="<?php 
                               if(isset($_POST['changevalue'])){
                               echo $userList[0]->getAddress();
                              }
                              else {
                               echo null;
                              }
                               ?>"placeholder="Address" class="form-control"/>
                          </div>
                      </div >
                      <input style="width: 75px;" type="submit" name="updateAccount" value="Update" class="btn btn-info pull-left">                    
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Create Company</a>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
              <div class="panel-body">
                <form method="post" action="#" role="login">
                  <div class="col-md-4" >
                      <div class="form-group">
                          <label for="InputName">Tax Id</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" id="taxid" name="TaxId" placeholder="Tax Id" required class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Company Name</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" name="CompanyName" placeholder="Company Name" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Email</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" name="Email" placeholder="Email" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Phone Number</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" name="PhoneNumber" placeholder="Phone Number" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Password</label>
                          <div class="input-group">
                              <input type="password" style="width: 360px;" name="Password" placeholder="Password" class="form-control"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="InputName">Address</label>
                          <div class="input-group">
                              <input type="text" style="width: 360px;" name="Address" placeholder="Address" class="form-control"/>
                          </div>
                      </div >
                      <input style="width: 75px;" type="submit" name="createAccount" value="Create" class="btn btn-info pull-left">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Delete</a>
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
              <div class="panel-body">
                <form method="post" action="#" role="login">
                  <div class="col-md-4" >
                      <div class="form-group">
                          <label for="InputName">Tax Id</label>
                          <div class="input-group">
                              <select class="form-control" name="SelectedDeleteOption">
                                <option>Select</option>
                                <?php 
                                  $userList = BL_LoginManager::getAllCompanies();
                                  for($i = 0; $i < count($userList); $i++) {
                                  ?>
                                    <option><?php echo $userList[$i]->getTaxId(); ?></option>
                                  <?php
                                  }
                                ?>
                              </select>
                          </div>
                      </div>
                      <input style="width: 75px;" type="submit" id="deleteButton" name="deleteAccount" value="Delete" class="btn btn-info pull-left">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
      </div>
  </body>
</html>