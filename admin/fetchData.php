<?php

//---------------------------------------------- User table -----------------------------------------

include("../include/dbConnect.php");
if(isset($_POST['userFilter'])){

  $userTable='<br><br>';
    if(isset($_POST['msg'])){ 
            $userTable.='<div class="alert alert-success" role="alert">' . $_POST["msg"].' </div>';
          }
      if (isset($_POST["error"])) {
        $userTable.='<div class="alert alert-danger">' . $_POST["error"] . '</div>';
      }
       

    $userTable.='<div class="table-responsive">
    <table class="table table-hover " id="userTable">
    <thead style="background-color:#5786d6; color:#eee">
    <tr >
      <th scope="col">Profile</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Credit</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>';
    

   
    $userFilter = $_POST['userFilter'];
   if($userFilter==""){
    $selectAllUser = "SELECT * FROM users_details where FirstName <> 'admin' ";
   }else{
    $selectAllUser = "SELECT * FROM users_details WHERE Status like '".$userFilter."' AND FirstName <> 'admin' ";
   }
   
    $allUser = mysqli_query($con,$selectAllUser);
    $noOfUsers = mysqli_num_rows($allUser);

    if($noOfUsers>=1){
        while($row=mysqli_fetch_assoc($allUser))
        {
           
          $userTable.=' <tr>
                    <td><a href="../assets/picture/profiles/'.$row["ProfileImage"].'" > 
                    <img class="round-img" src="../assets/picture/profiles/'.$row["ProfileImage"].'" alt="Profile"/>
                    </a>
                    </td>
                    <td>'.$row["FirstName"].' '.$row["LastName"].'</td>
                    <td>'.$row["Email"].'</td>
                    <td>'.$row["Address"].'</td>
                    <td>'.$row["Credit"].'</td>
                    <td>'.$row["Status"].'</td>
                    <td>
                       
              <input type="hidden" name="userId" value="'.$row["UserId"].'"/> ';
              $userTable.="<button class='btn btn-info'  name='EditUser' onclick=\" editUser('".$row["UserId"]."') \"> Edit </button>";
              $userTable.="<button class='btn btn-danger' name='deleteUser' onclick=\"confirm('Are you want to delete  ".$row["FirstName"]."') && deleteUser('".$row["UserId"]."')\">Delete</button>
                     
                    </td>
            </tr>";
        }
      }
    else 
    {
    
      $userTable.='<tr><td colspan="8" style="color:red;text-align:center;">No records are found </td></tr>';
    
    }

    $userTable.='</tbody>
    </table></div>';
  echo $userTable;
  }

   //---------------------------------------------- Class List table -----------------------------------------

   if(isset($_POST['roomFilter'])){
    $roomTable='<br><br>';
    if(isset($_POST['msg'])){ 
            $roomTable.='<div class="alert alert-success" role="alert">' . $_POST["msg"].' </div>';
          }
      if (isset($_POST["error"])) {
        $roomTable.='<div class="alert alert-danger">' . $_POST["error"] . '</div>';
      }
       

        $roomTable.='<div class="table-responsive">
        <table class="table table-hover " id="userTable">
        <thead style="background-color:#5786d6; color:#eee">
        <tr >
      <th scope="col">Name</th>
      <th scope="col">People</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>';
    

   
    $roomFilter = $_POST['roomFilter'];
    $today = date('Y-m-d');
   if($roomFilter==""){
    $selectAllRoom = "SELECT * FROM classroom Order By cdate Desc";
   } else if($roomFilter=="Given"){
    $selectAllRoom = "SELECT * FROM classroom Where booker>0 And cdate<='".$today."' Order By cdate Desc";
   } else if($roomFilter=="Reserved"){
    $selectAllRoom = "SELECT * FROM classroom Where booker>0 And cdate>'".$today."' Order By cdate Desc";
   } else { //Cancelled Not Given
    $selectAllRoom = "SELECT * FROM classroom Where booker=0 And cdate<='".$today."' Order By cdate Desc";
   }

    $allRoom = mysqli_query($con,$selectAllRoom);
    $noOfrooms = mysqli_num_rows($allRoom);

    if($noOfrooms>=1){
        while($row=mysqli_fetch_assoc($allRoom))
        {
           
          $roomTable.=' <tr>
                    
                    <td>'.$row["className"].'</td>
                    <td>'.$row["people"].'</td>
                    <td>'.$row["cdate"].'</td>';
          if($row['cdate']<=$today){
            if($row['booker']>0){ //Given
              $roomTable.='<td>Given</td>
                    <td>                  
                      <input type="hidden" name="userId" value="'.$row["classID"].'"/> ';
            }
            else{ // Reserved
              $roomTable.='<td>Not Given</td>
                    <td>                  
                      <input type="hidden" name="userId" value="'.$row["classID"].'"/> ';
            }
          } else {  // Cancelled/Not Given
              $roomTable.='<td>Reserved</td>
                    <td>                  
                      <input type="hidden" name="userId" value="'.$row["classID"].'"/> ';
          }
          $roomTable.="<button class='btn btn-info'  name='EditUser' onclick=\" editRoom('".$row["classID"]."') \"> Edit </button>";
          $roomTable.="<button class='btn btn-danger' name='deleteUser' onclick=\"confirm('Are you want to delete the class number  ".$row["classID"]."') && deleteRoom('".$row["classID"]."')\">Delete</button>       
                </td>
                </tr>";
               
        }
      }
    else 
    {
    
      $roomTable.='<tr><td colspan="8" style="color:red;text-align:center;">No records are found </td></tr>';
    
    }

    $roomTable.='</tbody>
    </table></div>';
  echo $roomTable;
   } 
   
   
   //---------------------------------------------- Class Reservation table -----------------------------------------

   if(isset($_POST['roomBooking'])){

    $roomTable='<br><br>';
    if(isset($_POST['msg'])){ 
            $roomTable.='<div class="alert alert-success" role="alert">' . $_POST["msg"].' </div>';
          }
      if (isset($_POST["error"])) {
        $roomTable.='<div class="alert alert-danger">' . $_POST["error"] . '</div>';
      }
       

      $roomTable.='<div class="table-responsive">
        <table class="table table-hover " id="userTable">
        <thead style="background-color:#5786d6; color:#eee">
        <tr >
          <th scope="col">User</th>
          <th scope="col">Date</th>
          <th scope="col">Class Name</th>
          <th scope="col">Class Date</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>';
    
      $filter = $_POST['filter'];

      if($filter=="All"){
        $selectBooking =  "SELECT reserved.*, cl.className, cl.cdate, ud.Email FROM reserved 
                                inner join classroom cl on reserved.classID = cl.classID
                                inner join users_details ud on reserved.userID = ud.UserId
                                order by reserved.RDate desc";
      } else {
        $selectBooking =  "SELECT reserved.*, cl.className, cl.cdate, ud.Email FROM reserved 
                                inner join classroom cl on reserved.classID = cl.classID
                                inner join users_details ud on reserved.userID = ud.UserId
                                Where reserved.Status='$filter' order by reserved.RDate desc";
      }

      $booking = mysqli_query($con,$selectBooking);
      $noOfBooking = mysqli_num_rows($booking);
      $today = date('Y-m-d');
      if($noOfBooking>=1){
        while($row=mysqli_fetch_assoc($booking)) {
          $status = $row['Status'];
          if($row['Status']=='Reserved' && $row['cdate']<=$today){
            $status = 'Given';
            $updateSQL = "Update reserved SET Status='Given' Where bookID=".$row['bookID'];
            mysqli_query($con,$updateSQL);
          }
         $roomTable.=' <tr>                   
                   <td>'.$row["Email"].'</td>
                   <td>'.$row["RDate"].'</td>
                   <td>'.$row["className"].'</td>
                   <td>'.$row["cdate"].'</td>
                   <td>'.$status.'</td>';
         if($row['Status']=='Reserved' && $row['cdate']>$today){
           $roomTable.='<td><input type="hidden" name="userId" value="'.$row["classID"].'"/>';
           $roomTable.="<button class='btn btn-danger' name='cancelClass' onclick=\"confirm('Are you want to cancel the class number  ".$row["bookID"]."') && cancelClass('".$row["bookID"]."')\">Cancel</button></td>";       
         } else{
            $roomTable.="<td></td>";
         }
         $roomTable.="</tr>";
        }
      }   else    {
        $roomTable.='<tr><td colspan="5" style="color:red;text-align:center;">No records are found </td></tr>';
      }
    $roomTable.='</tbody>
                 </table></div>';
    echo $roomTable;
  } 

// ------------------------------------------- Classroom Details - ----------------------------
if(isset($_POST['classroomCalendar'])){
  $data = [];
  $cnt = 0;
  $classroom = "SELECT * FROM classroom";

  $all = mysqli_query($con,$classroom);
  $noOfClass = mysqli_num_rows($all);

  if($noOfClass>=1){
    while($row=mysqli_fetch_assoc($all))
    {
      if($row['ctime']<10){
        $data[$cnt] = [
            'title'=>$row['className'],
            'start'=>$row['cdate'].'T0'.$row['ctime'].':00:00'
        ];
      }else{
        $data[$cnt] = [
          'title'=>$row['className'],
          'start'=>$row['cdate'].'T'.$row['ctime'].':00:00'
        ];
      }
      $cnt++;
    }
  }
  echo json_encode($data);
}
?>