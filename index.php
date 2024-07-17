<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reservation</title>
    <!-- bootstrap  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <!-- Google Fonts  -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet">

  <!-- font awesome  -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<!-- Styling -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/gallery.css">
  <link rel="stylesheet" href="assets/css/form_style.css">

  <!-- Favicons -->
  <link href="assets/picture/favicon.jpg" rel="icon">
</head>

<body>

<?php 
    include('./include/functions.php');
    include('./include/general.php');

    if(isset($_SESSION['loggedUserId'])) {
        $id = $_SESSION['loggedUserId'];
        $s="select * from  users_details where UserId='$id' ";
        $result=mysqli_query($con,$s) or die ('failed to query');
        $user_details= mysqli_fetch_assoc($result);
    }
  
    if(isset($user_details['FirstName'])){
        if($user_details['Email']=="admin@gmail.com"){
            header("Location:admin/addClass.php?");
        }
        else 
        {
            header("Location:client/home.php?");
        }
    }
?>

<div class="container">
    <div class="row align-items-center my-5">
        <!-- For Demo Purpose -->
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
            <img src="assets/picture/icons/thumbs-up.png" alt="" class="img-fluid mb-3 d-none d-md-block">
            <h2>Class Reservation System</h2>
            <p class="font-italic text-muted mb-0">Information provided below will be used to sign in to your Class Reservation account.</p>           
            </p>
        </div>

        <!-- Registeration Form -->
        <div class="col-md-3 col-lg-5 ml-auto">
        <div class="login-form">
         <form action="validation.php" method="POST" enctype="multipart/form-data" >
        <h2 class="text-center mb-4">Sign in</h2>
        <?php
                if (isset($_GET["error"])) {
                    echo '<div class="text-danger text-center">' . $_GET["error"] . '</div>';
                }
        ?>   
        <div class="form-group mt-3">
        	<div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fa fa-user"></span>
                    </span>                    
                </div>
                <input type="text" class="form-control" name="email" placeholder="Email" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">				
            </div>
        </div>    
        <!-- <div class="clearfix mb-3">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div> -->

        <div class="form-group ">
            <button type="submit" name="user_login" class="btn btn-primary login-btn btn-block">Sign in</button>
        </div>
 
		<div class="or-seperator"><i>or</i></div>
    </form>
    <p class="text-center text-muted small">Don't have an account? <a href="signup.php">Sign up here!</a></p>
</div>
        </div>
    </div>
</div>

<script  src="assets/js/index.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     </body>
</html>

