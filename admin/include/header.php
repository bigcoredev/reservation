<?php include('../include/functions.php');
include('../include/general.php');
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Reservation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		<!-- template  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/css/adminPanel.css">

		<!-- own styling  -->
		<link rel="stylesheet" href="../assets/css/adminStyle.css">
		<link rel="stylesheet" href="../assets/css/form_style.css">
		<link rel="stylesheet" href="../assets/css/gallery.css">
		<link rel="stylesheet" href="../assets/css/booking_card.css">

		<!-- Jquery data tables pagination  -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.6.0/dt-1.11.2/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.6.0/dt-1.11.2/datatables.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

		<script src='../assets/fullcalendar/dist/index.global.js'></script>

		<!-- Favicons -->
		<link href="../assets/picture/favicon.jpg" rel="icon">
  </head>
  <body>
		
	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar" class="navbar-dark" style="background-color: rgba(1, 4, 136, 0.9)">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn"  style="background-color: rgba(1, 4, 136, 1); color: #fff">
	          		<i class="fa fa-bars"></i>
	          		<span class="sr-only">Toggle Menu</span>
	        	</button>
            </div>


			<div class="p-4 pt-5">
		  		<h2><a href="addClass.php" class="logo"><?php echo $general_setting['Name'] ?></a></h2>
		        <ul class="list-unstyled components mb-5" id="nav">
				<li class="nav-item">
					<a class="tab" href="account.php">Profile</a>
				</li>
				<li class="nav-item">
                    <a class="tab" href="reservation.php">View Reservation</a>
                </li>
				<li class="nav-item">
					<a class="tab" href="addClass.php">Add Classes</a>
				</li>
				<li class="nav-item">
                    <a class="tab" href="classes.php">Classes</a>
                </li>
				<li class="nav-item">
					<a class="tab" href="user.php">Users</a>
				</li>
				<li class="nav-item">
    	          <a class="tab" href="../destroy.php">Logout</a>
				</li>
				</ul> 

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						 
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>


    	</nav>
