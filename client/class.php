<?php include('include/header.php') ;
if(!isset($_SESSION['loggedUserId'])) {
 header('Location:../index.php');
}
?>
 <div class="container-fluid p-5" id="roomType">

 <!-- Add Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reserve Class</h5>
        <button id="btnClose" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="client_functions.php" method="POST" id="model-reserveClassType" autocomplete="off">
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
             <button type="submit" class="btn btn-primary">Reserve</button>
             <button type="button" id="btnClose2" class="btn btn-secondary">Close</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


    <div class="row justify-content-center pb-2">
        <div class="col-md-6 heading-section text-center">
            <h2 class="mt-5 pt-3">Select Class ( Your Class Credits : <span id="credits"></span> )</h2>
            <br>
            <div id='calendar'></div>
        </div>
    </div>
 </div>
<script>

function getClassDetails(classname, cdate) {
    $.ajax({
        url:"fetchData.php",
        type:"POST",
        data:{
            roomType: true,
            classname : classname,
            cdate: cdate,
        },
        success:function(data){
            const d = JSON.parse(data);
            $('#people').val(d[0].people);    
            $('#zone').val(d[0].zone);    
            $('#location').val(d[0].location);    
            $('#ctime').val(d[0].ctime);    
            $('#cdate').val(d[0].cdate);    
            $('#duration').val(d[0].duration);
            $('#addModal').modal('show');
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    })
}


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
      var res = JSON.parse(data);
      document.getElementById('credits').innerHTML = res[res.length-1]['Credit'];

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
        //   var selectedDate = info.dateStr;
        //   console.log('Selected Date: '+selectedDate);
        //   document.getElementById("cdate").value = selectedDate;
        //   $('#addModal').modal('show');
        },
        eventClick: function(info) {
            var credit = document.getElementById('credits').innerText;
            if(credit=='0' || credit=="")
                alert("You cannot reserve class. Please increase your class credits.");
            else{
                var e = info.event;
                $('#classname').val(e.title);
                getClassDetails(e.title, e.start.toISOString().substring(0,7));
            }
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
<script src ="js/class_function.js" ></script>

<?php include('include/footer.php')?>

