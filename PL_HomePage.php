<?php
	session_start();
  require_once("../BusinessLayer/BL_LoginManager.php");
  
	if (isset($_POST["logout"])) {
		unset($_SESSION['CompanyName']);
		unset($_SESSION['AccountId']);
    header("Location:../PresentationLayer/PL_Login.php");
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

    <title>Home Page</title>


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
                      <a href="PL_MyAccount.php" class="">
                          <i class="icon_document_alt"></i>
                          <span>My Account</span>
                      </a>
                  </li>       
                  <li class="sub-menu">
                      <a href="PL_CreditCard.php" class="">
                          <i class="icon_desktop"></i>
                          <span>Credit Card</span>
                      </a>
                  </li>
                  <li>
                      <a class="" href="PL_PaymentPage.php">
                          <i class="icon_genius"></i>
                          <span>Payments</span>
                      </a>
                  </li>
                  <li>                     
                      <a class="" href="PL_TransferMoney.php">
                          <i class="icon_piechart"></i>
                          <span>Money Transfer</span>
                      </a>              
                  </li>  
                  <li class="sub-menu">
                      <a href="PL_Loan.php" class="">
                          <i class="icon_table"></i>
                          <span>Loan</span>
                      </a>
                  </li>
              </ul>
          </div>
      </aside>
      <div class="container">                                                                                 
        <div class="table-responsive">          
          <table class="table" style="margin-top:150px;margin-left: 200px;width: 700px; ">
            <thead>
              <tr>
                <th>#</th>
                <th>Account Number</th>
                <th>Balance</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $taxId = $_SESSION['AccountId'];
                $userList = BL_LoginManager::getAllAccounts($taxId);
                for($i = 0; $i < count($userList); $i++) {
                  ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $userList[$i]->getAccountId(); ?></td>
                    <td><?php echo $userList[$i]->getBalance(); ?></td>
                    <td><button name="detail" class="btn btn-sm btn-primary ">Detail</button></td>
                  </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
    </div>
  </body>
</html>