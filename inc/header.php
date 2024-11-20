<?php

$basepath = dirname(__DIR__);
include $basepath.'/config/database.php';

if(!isset($_SESSION['email']))
{
	header('Location:'.BSURL.'index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>inoday Discover</title>
	<link rel="stylesheet" href="<?php echo BSURL;?>style.css">
	<link rel="icon" type="image/gif" href="<?php echo BSURL;?>assets/img/logo-fevicon.png">
	<link rel="stylesheet" type="text/css" href="<?php echo BSURL;?>assets/css/style.css">
  	<link rel="stylesheet" href="<?php echo BSURL;?>assets/css/bootstrap.css">
  	<script src="<?php echo BSURL;?>assets/js/jquery.js"></script>
  	<link rel="stylesheet" href="<?php echo BSURL;?>assets/css/font-awesome.css">
</head>
<body>
	<div class="wrapper">
		

		<nav class="navbar navbar-expand-sm navbar-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="<?php echo BSURL;?>app/dashboard.php"><img src="<?php echo BSURL;?>assets/img/inoday-logo.png"></a>
		    
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="collapsibleNavbar">
		      <ul class="navbar-nav ml-auto">
		        
		        <?php
		        if($role == "User")
		        {
		        	?>
		        	<li class="nav-item">
			          <a class="nav-link" href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
			        </li>
			        <li class="nav-item dropdown">
				      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				        <i class="fa fa-user"></i> <?php echo $name;?>
				      </a>
				      <div class="dropdown-menu">
				        <a class="dropdown-item" href="profile.php">User Profile</a>
				        <a class="dropdown-item" href="logout.php">Logout</a>
				      </div>
				    </li>
		        	<?php
		        }
		        else
		        {
		        	?>
		        	<li class="nav-item">
			          <a class="nav-link" href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="data-report.php"><i class="fa fa-pie-chart"></i> Data Report</a>
			        </li>
			         <li class="nav-item">
			          <a class="nav-link" href="setting.php"><i class="fa fa-cog"></i> Setting</a>
			        </li>
			        <li class="nav-item dropdown">
				      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				        <i class="fa fa-user"></i> <?php echo $name;?>
				      </a>
				      <div class="dropdown-menu">
				        <a class="dropdown-item" href="profile.php">User Profile</a>
				        <a class="dropdown-item" href="password.php">Password</a>
				        <a class="dropdown-item" href="logout.php">Logout</a>
				      </div>
				    </li>
		        	<?php
		        }
		        ?>
		        
		      </ul>
		    </div>
		  </div>
		</nav>
