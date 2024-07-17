// display the room types with ajax
function roomBooking(value,msg,err){
    var Data = {
        roomBooking:true,
        filter : value
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

    })
}

// set the status cancel
function cancelClass(bookID){
  $.ajax({
    url:"admin_functions.php",
    type:"POST",
    data:{
      reserveClassCancel : true,
      bookID : bookID
    },
    success:function(data){      
      var json = JSON.parse(data);
      var value = $("#roomBookingFilter").val();
      if(!value){
        value = 'All';
      }
      if(json['error']!=""){
          roomBooking(value,"",json['error']);
      }else{
          roomBooking(value,json['msg'],"");
      }
   },
   error: function(data){
       console.log("error");
       console.log(data);
   }
  });
}


// Document Ready Function 
$(document).ready(function(){

    roomBooking("All","","");
    $("#roomBookingFilter").on("change",function(){
        var value = $(this).val();
        roomBooking(value,"","");
    });

});