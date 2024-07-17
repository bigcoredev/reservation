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

<h2 class="mb-4">Classes</h2>

 <!-- table for the display the content  -->
 <div id='calendar' class="container-fluid"></div>

 <!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="admin_functions.php" method="POST" id="model-addRoomType" autocomplete="off">
            <div class="row">
              <!-- Name  -->
              <div class="input-group col-lg-12 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-pencil text-muted"></i>
                      </span>
                  </div>
                  <input id="classname" type="text" name="classname" placeholder="Class Name" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- People  -->
              <div class="input-group col-lg-12 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-user text-muted"></i>
                      </span>
                  </div>
                  <input id="people" type="text" name="people" placeholder="People" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Zone  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-home text-muted"></i>
                      </span>
                  </div>
                  <input id="zone" type="text" name="zone" placeholder="Zone" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Location  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-home text-muted"></i>
                      </span>
                  </div>
                  <input id="location" type="text" name="location" placeholder="Location" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Date  -->
              <div class="input-group col-lg-12 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-calendar text-muted"></i>
                      </span>
                  </div>
                  <input id="cdate" type="text" name="cdate" placeholder="Date" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Time  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-clock-o text-muted"></i>
                      </span>
                  </div>
                  <input id="ctime" type="text" name="ctime" placeholder="Time" class="form-control bg-white border-left-0 border-md" required>
              </div>
              <!-- Duration  -->
              <div class="input-group col-lg-6 mb-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white px-4 border-md border-right-0">
                          <i class="fa fa-clock-o text-muted"></i>
                      </span>
                  </div>
                  <input id="duration" type="text" name="duration" placeholder="Duration (hours)" class="form-control bg-white border-left-0 border-md" required>
              </div>


            </div>
           <div class="modal-footer">
             <button type="submit" class="btn btn-primary">Add</button>
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

</div>

</div>
<!-- Page Content end here-->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var Data = {classroomCalendar: "ALL"};
    $.ajax({
    url:"fetchData.php",
    type:"POST",
    data:Data,
    // beforeSend:function(){
    //   $('#contentArea').html("<br><br><span>Working...</span>");
    // },
    success:function(data){
      console.log(JSON.parse(data));
      const timeElapsed = Date.now();
      const today = new Date(timeElapsed).toISOString().substring(0,10);

      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,,listMonth'
        },
        initialDate: today,
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
        selectable: true,
        dateClick: function (info) {
          var selectedDate = info.dateStr;
          console.log('Selected Date: '+selectedDate);
          document.getElementById("cdate").value = selectedDate;
          $('#addModal').modal('show');
        },
        events: JSON.parse(data)        
      });

      calendar.render();
    },
    error: function(data){
      console.log("error");
      console.log(data);
    }
  });
  });

</script>
<script src="js/addclass_function.js" type="text/javascript"></script>

<?php include("include/footer.php"); ?>