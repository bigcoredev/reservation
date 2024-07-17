<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reservation</title>

    <!-- bootstrap  -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
		<!-- Jquery data tables pagination  -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.6.0/dt-1.11.2/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.6.0/dt-1.11.2/datatables.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">

    <!-- Styling -->
		<link rel="stylesheet" href="../assets/css/adminStyle.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/gallery.css">
    <link rel="stylesheet" href="../assets/css/form_style.css">

    <script src='../assets/fullcalendar/dist/index.global.js'></script>

  <!-- Favicons -->
  <link href="../assets/picture/favicon.jpg" rel="icon">
</head>
<body>

 
<?php 
include('../include/functions.php');
include('../include/general.php');

if(isset($_SESSION['loggedUserId'])) {
    $id = $_SESSION['loggedUserId'];
    $s="select * from  users_details where UserId='$id' ";
    $result=mysqli_query($con,$s) or die ('failed to query');
    $user_details= mysqli_fetch_assoc($result);
   
}
  
  if(isset($user_details['FirstName'])){
  ?>

<!-- <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1><a href="#"><i class="ri-calendar-todo-line" style="color: #e80368;"></i> <span> Reservation</span></a>
            </h1> -->
        <!-- </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="../guest/home.php">Home</a></li>
                <li><a class="nav-link scrollto active" href="../admin/profile.php">Profile</a></li>
                <li><a class="nav-link scrollto" href="#gallery">View</a></li>
                <li><a class="nav-link scrollto" href="#team">Add</a></li>
                <li><a class="nav-link scrollto" href="#pricing">Create</a></li>
                <li><a class="nav-link scrollto" href="../logout.php">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i> -->
        <!-- </nav>

    </div>
</header>End Header -->

<!-- navbar two (when user log in)  -->
<!-- <nav id="navbar_top" class="navbar navbar-expand-lg fixed-top" > -->
   <nav id="header" class="fixed-top d-flex align-items-center" >
    <div class="container d-flex align-items-center justify-content-between">
      <div class='logo'>
        <h1><a href="home.php"> <i class="fas fa-calendar me-4" style="color: #e80368;"></i> Reservation</a></h1>
      </div>

      <ul class="navbar navbar-nav navbar-expand-lg">
        <li class="nav-item p-2">
          <a class="nav-link scrollto" href="class.php">Select Class</a>
        </li>
        <li class="nav-item p-2">
          <a class="nav-link scrollto" href="mybooking.php">Classes Given/Reserved</a>
        </li>
        <li class="nav-item p-2">
          <a class="nav-link scrollto" href="account.php">Profile</a>
        </li>
        <li class="nav-item p-2">
          <a class="nav-link scrollto" href="../destroy.php">Log Out</a>
        </li>        
    </div>
  </nav>
 <?php } ?>