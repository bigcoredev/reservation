// function to display content of user
function displayClasses(value1,value2, msg,err){
  var Data = {
    classesFilter : value1,
    search: value2
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
        ordering:true
      });
    },
    error: function(data){
      console.log("error");
      console.log(data);
  }
  });
}

$(document).ready(function(){
    displayClasses('1','','','');
      
    //Filter for the room type
    $('#classesFilter').on('change',function(){
      var value1 = $('#classesFilter').val();
      var value2 = $('#search').val();
      displayClasses(value1,value2, "","");
    });

    $('#btnsearch').on('click',function(){
      var value1 = $('#classesFilter').val();
      var value2 = $('#search').val();
      displayClasses(value1, value2, "","");
    });

    // $('#search').on('change',function(){
    //   var value1 = $('#classesFilter').val();
    //   var value2 = $('#search').val();
    //   displayClasses(value1, value2, "","");
    // });
})
