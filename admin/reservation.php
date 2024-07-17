<?php 
include("include/header.php");
if(!isset($_SESSION['loggedUserId'])) {
    echo "<script> window.location.href = '../index.php';</script>";
}
else if($_SESSION['loggedUserEmail']!="admin@gmail.com") {
    session_destroy();
    echo "<script> window.location.href = '../index.php';</script>";
}
?>


<!-- Page Content  -->
<div id="content" class="p-4 p-md-5 pt-5">

<h2 class="mb-2">Class Reservation</h2>
    
 <!-- Filter Drop down  -->
<div class="float-right filterBy">
<select name="category" id="roomBookingFilter" class="form-control custom-select bg-white border-md filter">
  <option disabled="" selected="" value="All">FilterBy </option>
  <option value="All">All</option>
  <option value="Reserved">Reserved</option>
  <option value="Given">Given</option>
  <option value="Cancelled">Cancelled</option>
</select>
</div>


 <!-- table for the display the content  -->
 <div class="container-fluid" id="contentArea">

        
</div>


</div>

<script src="js/reservation_function.js" type="text/javascript"></script>

<?php include("include/footer.php"); ?>