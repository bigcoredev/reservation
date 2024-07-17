// display the room types with ajax
// function displayRoomTypes(value){

//     $.ajax({
//         url:"fetchData.php",
//         type:"POST",
//         data:{
//             roomType:true,
//             filter : value
//         },
//         beforeSend:function(){
//             $('#contentArea').html("<br><br><span>Working...</span>");
//           },
//           success:function(data){
//             $('#contentArea').html(data);
         
//           },
//           error: function(data){
//             console.log("error");
//             console.log(data);
//         }

//     })
// }

$(document).ready(function(){
    $("#btnClose").click(function(){
        $('#addModal').modal('hide');
    });

    $("#btnClose2").click(function(){
        $('#addModal').modal('hide');
    });

    $('#model-reserveClassType').on('submit',(function(e) {
        e.preventDefault();
       
        var formData = new FormData(this);
        $.ajax({
            type:"POST",
            url: "client_functions.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
         
            success:function(data){
            
              //var json = JSON.parse(data);
              // hiding the modal and clearing the content
              $('#addModal').modal('hide');
              $('#model-reserveClassType')[0].reset(); 
                   
                location.href = 'class.php';
            },
            error: function(data){
                console.log("error");
                console.log(data);
                $('#addModal').modal('hide');
            }
        });  
    }));
});