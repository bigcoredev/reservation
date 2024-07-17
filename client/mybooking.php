<?php 

include('include/header.php') ;
if(!isset($_SESSION['loggedUserId'])) {
  header('Location:../index.php');
 }
 
?>

<div class="container-fluid p-5" id="roomType">
    <div class="row justify-content-center pb-2">
        <div class="col-md-7 heading-section text-center">
            <h2 class="mt-5 pt-3">Classes Reservation History</h2>
        </div>
    </div>

    <div class="row">

      <div class="col-lg-12 mb-4">
          <div class="tab-pane fade show active" id="nav-room" role="tabpanel" aria-labelledby="nav-home-tab">

          <!-- Filter Drop down  -->
            <div class="float-right filterBy">
              <select name="category" id="classResFilter" class="form-control custom-select bg-white border-md filter">
                <option disabled="" selected="" value="0">FilterBy </option>
                <option value="1">Reserved</option>
                <option value="2">Given</option>
                <option value="3">Cancelled</option>
              </select>
            </div>
            <br>

            <div class="container" id="contentArea" style="min-height: 413px">

            </div>
          </div>
        
        </div>
      </div>
    </div>
  </div>
    
</section>

<script src="js/reserve_class.js"></script>

<?php include('include/footer.php')?>


 