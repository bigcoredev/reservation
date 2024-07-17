// function to display content of user
function displayClasses(value,msg,err){
  var Data = {
    roomFilter : value
  }
  if(msg!=""){
    Data.msg = msg;
  }
  if(err!=""){
    Data.error = err;
  }

  $.ajax({
    url:"fetchData.php",
    type:"POST",
    data:Data,
    beforeSend:function(){
      $('#contentArea').html("<br><br><span>Working...</span>");
    },
    success:function(data){
      $('#contentArea').html(data);
     // data table from the Jquery dataTable.net
    $('table').DataTable({
      paging:true,
      ordering:true,
      searching:true
    });
    },
    error: function(data){
      console.log("error");
      console.log(data);
  }
  });
}

//function to delete the user 

function deleteRoom(roomId){

  console.log(roomId);
  $.ajax({
    url:"admin_functions.php",
    type:"POST",
    data:{
      roomId : roomId,
      deleteRoom:true
    },
    success:function(data){      
      console.log("success");
      console.log(data);
      var json = JSON.parse(data);
      if(json['error']!=""){
       displayClasses("","",json['error']);
      }else{
        displayClasses("",json['msg'],"");
      }
      
       
   },
   error: function(data){
       console.log("error");
       console.log(data);
   }
  });
}

//function to delete the user 
function editRoom(roomId){
   $('#updateRoomId').val(roomId);
   $.post('admin_functions.php',{roomUpdateId:roomId},function(data,status){
     console.log(data);
      roomData = JSON.parse(data);     
     
      $('#editclassname').val(roomData.className);
      $('#editpeople').val(roomData.people);
      $('#editzone').val(roomData.zone);
      $('#editlocation').val(roomData.location);
      $('#edittime').val(roomData.ctime);
      $('#editduration').val(roomData.duration);
      $('#editdate').val(roomData.cdate);
   });
   $('#updateModal').modal("show");
}

$(document).ready(function(){
    displayClasses('','','');
      

    //Filter for the room type
    $('#roomFilter').on('change',function(){
      var value = $(this).val();
      displayClasses(value,"","");
    });

    // invoking the modal for add new type of room
      $('#addRoomBtn').on('click',function(){
        $('#addModal').modal('show');
      });

    //update the content of room
    $('#modal-updateRoom').on('submit',(function(e) {
      e.preventDefault();
 
      var formData = new FormData(this);

      $.ajax({
          type:"POST",
          url: "admin_functions.php",
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
      
          success:function(data){
            console.log("success");
            console.log(data);
            $('#updateModal').modal("hide");
            var json = JSON.parse(data);
            if(json['error']!=""){
              displayClasses("","",json['error']);
            }else{
              displayClasses("",json['msg'],"");
            }
              
          },
          error: function(data){
              console.log("error");
              console.log(data);
          }
      });
    }));
})
