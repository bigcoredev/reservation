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

<h2 class="mb-1">Classes</h2>
<!--Edit Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="admin_functions.php" method="POST" id="modal-updateRoom" autocomplete="off">
      <div class="row">
              <!-- Name  -->
              <div class="input-group col-lg-12 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-pencil text-muted"></i>
                      </span>
                  </div>
                  <input id="editclassname" type="text" name="editclassname" placeholder="Class Name" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- People  -->
              <div class="input-group col-lg-12 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-user text-muted"></i>
                      </span>
                  </div>
                  <input id="editpeople" type="text" name="editpeople" placeholder="People" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Zone  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-home text-muted"></i>
                      </span>
                  </div>
                  <input id="editzone" type="text" name="editzone" placeholder="Zone" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Location  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-home text-muted"></i>
                      </span>
                  </div>
                  <input id="editlocation" type="text" name="editlocation" placeholder="Location" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Date  -->
              <div class="input-group col-lg-12 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-calendar text-muted"></i>
                      </span>
                  </div>
                  <input id="editdate" type="text" name="editdate" placeholder="Date" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Time  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-clock-o text-muted"></i>
                      </span>
                  </div>
                  <input id="edittime" type="text" name="edittime" placeholder="Time" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Duration  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-clock-o text-muted"></i>
                      </span>
                  </div>
                  <input id="editduration" type="text" name="editduration" placeholder="Duration (hours)" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- for getting the id when the form is submitted  -->
              <input type="hidden" id="updateRoomId" name="updateRoomId">

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
      </div>
      </form>
      </div>
     
    </div>
  </div>
</div>

<br>
 <!-- Filter Drop down  -->
 <div class="float-right filterBy">
<select name="category" id="roomFilter" class="form-control custom-select bg-white border-md filter">
  <option disabled="" selected="">FilterBy  </option>
  <option value="">All</option>
  <option value="Given">Given</option>
  <option value="Reserved">Reserved</option>
  <option value="Not Given">Not Given</option>
</select>
</div>
 <!-- table for the display the content  -->
 <div class="container-fluid" id="contentArea">

</div>


</div>

<script src="js/classes_function.js" ></script>
<?php include("include/footer.php"); ?>