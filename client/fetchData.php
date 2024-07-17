<?php
include("../include/functions.php");

// --------Home.php Classes Search---------------------------------------------------------------
if(isset($_POST["classesFilter"])){
  $classesFilter = $_POST['classesFilter'];
  $search = $_POST["search"];

  $classesTable = '';
  if(isset($_POST['msg'])){ 
    $classesTable.='<div class="alert alert-success" role="alert">' . $_POST["msg"].' </div>';
  }
  if (isset($_POST["error"])) {
    $classesTable.='<div class="alert alert-danger">' . $_POST["error"] . '</div>';
  }

  $classesTable.='<div class="table-responsive">
      <table class="table table-hover " id="userTable">
      <thead style="background-color:#5786d6; color:#eee">
      <tr >
        <th scope="col">Name</th>
        <th scope="col">People</th>
        <th scope="col">Zone</th>
        <th scope="col">Location</th>
        <th scope="col">Date</th>
        <th scope="col">Status</th>    
      </tr>
      </thead>
      
      <tbody>';
  
  $today = date('Y-m-d');
  if($classesFilter=="1" && $search!=""){
    $selectAllClass = "SELECT * FROM classroom Where className Like '%$search%' Order By cdate Desc";
  }else if($classesFilter=="2" && $search!=""){
    $selectAllClass = "SELECT * FROM classroom Where people Like '%$search%' Order By cdate Desc";
  }else if($classesFilter=="3" && $search!=""){
    $selectAllClass = "SELECT * FROM classroom Where zone Like '%$search%' Order By cdate Desc";
  }else if($classesFilter=="4" && $search!=""){
    $selectAllClass = "SELECT * FROM classroom Where location Like '%$search%' Order By cdate Desc";
  } else {
    $selectAllClass = "SELECT * FROM classroom Order By cdate Desc";
  }

  $allClass = mysqli_query($con,$selectAllClass);
  $noOfclasses = mysqli_num_rows($allClass);

  if($noOfclasses>=1){
      while($row=mysqli_fetch_assoc($allClass))
      {
        $classesTable.=' <tr>
                  <td>'.$row["className"].'</td>
                  <td>'.$row["people"].'</td>
                  <td>'.$row["zone"].'</td>
                  <td>'.$row["location"].'</td>
                  <td>'.$row["cdate"].'</td>';
        if($row['cdate']<=$today){
          if($row['booker']>0){ //Given
            $classesTable.='<td>Given</td>';
          }
          else{ // Reserved
            $classesTable.='<td>Not Given</td>';
          }
        } else {  // Cancelled/Not Given
          $classesTable.='<td>Reserved</td>';
        }
        $classesTable.='</tr>';
      }
  }  else   {
    $classesTable.='<tr><td colspan="6" style="color:red;text-align:center;">No records are found </td></tr>';
  }
  $classesTable.='</tbody>
  </table></div>';
  echo $classesTable;
}

// ------Get Class Details - ----------------------------
if(isset($_POST['roomType'])){
    $classname = $_POST['classname'];
    $cdate = $_POST['cdate'];
    $data = [];

    $classroom = "SELECT * FROM classroom Where className='$classname' And cdate Like '$cdate%'";
    $all = mysqli_query($con,$classroom);
    $noOfClass = mysqli_num_rows($all);
    if($noOfClass>=1){
      if($row=mysqli_fetch_assoc($all)) {
          $data[0] = [
            'classname'=>$row['className'],
            'people'=>$row['people'],
            'zone'=>$row['zone'],
            'location'=>$row['location'],
            'cdate'=>$row['cdate'],
            'ctime'=>$row['ctime'],
            'duration'=>$row['duration'],
          ];
      }
    }
    echo json_encode($data);
}

// --------- class.php Classes Calendar Details - ----------------------------
if(isset($_POST['classroomCalendar'])){
    $data = [];
    $cnt = 0;
    $today = date('Y-m-d');
    $classroom = "SELECT * FROM classroom Where booker=0 And cdate>'$today'";
  
    $all = mysqli_query($con,$classroom);
    $noOfClass = mysqli_num_rows($all);
  
    if($noOfClass>=1){
      while($row=mysqli_fetch_assoc($all))
      {
        if($row['ctime']<10){
          $data[$cnt] = [
              'title'=>$row['className'],
              'start'=>$row['cdate'].'T0'.$row['ctime'].':00:00',
          ];
        }else{
          $data[$cnt] = [
            'title'=>$row['className'],
            'start'=>$row['cdate'].'T'.$row['ctime'].':00:00',
            ];
        }
        $cnt++;
      }
    }

    $userId = $_SESSION['loggedUserId'];
    $userSQL = "SELECT * FROM users_details Where UserId='$userId'";
    $user = mysqli_query($con,$userSQL);
    if(mysqli_num_rows($user)>0){
      $row=mysqli_fetch_assoc($user);
      $data[$cnt] = [
        'Credit'=> $row['Credit'],
      ];
    }
    echo json_encode($data);
  }

// ------------- Classes Reservation History --------------------------------
if(isset($_POST['roomBooking'])){
    $classTable='<br><br>';
    if(isset($_POST['msg'])){ 
        $classTable.='<div class="alert alert-success" role="alert">' . $_POST["msg"].' </div>';
    }
    if (isset($_POST["error"])) {
        $classTable.='<div class="alert alert-danger">' . $_POST["error"] . '</div>';
    }

    $classTable.='<div class="table-responsive">
        <table class="table table-hover " id="userTable">
        <thead style="background-color:#5786d6; color:#eee">
        <tr >
                <th scope="col">Class Name</th>
                <th scope="col">Date</th>
                <th scope="col">Reserved</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>';
   
    $filter = $_POST['filter'];
    $today = date('Y-m-d');
    $userId = $_SESSION['loggedUserId'];

    if($filter==0){
      $selectBooking =  "SELECT reserved.*, cl.className, cl.cdate FROM reserved 
                              inner join classroom cl on reserved.classID = cl.classID
                              Where reserved.userID='$userId' order by reserved.RDate, cl.cdate desc";
    } else if($filter==1){
      $selectBooking =  "SELECT reserved.*, cl.className, cl.cdate FROM reserved 
                              inner join classroom cl on reserved.classID = cl.classID
                              Where reserved.userID='$userId' And Status='Reserved' order by reserved.RDate, cl.cdate desc";
    } else if($filter==2){
      $selectBooking =  "SELECT reserved.*, cl.className, cl.cdate FROM reserved 
                              inner join classroom cl on reserved.classID = cl.classID
                              Where reserved.userID='$userId' And Status='Reserved' And cl.cdate<='$today' order by reserved.RDate, cl.cdate desc";
    } else { //Cancelled Not Given
      $selectBooking =  "SELECT reserved.*, cl.className, cl.cdate FROM reserved 
                              inner join classroom cl on reserved.classID = cl.classID
                              Where reserved.userID='$userId' And Status='Cancelled' order by reserved.RDate, cl.cdate desc";
    }

    $allClass = mysqli_query($con,$selectBooking);
    $noOfclasses = mysqli_num_rows($allClass);
    if($noOfclasses>=1){
      while($row=mysqli_fetch_assoc($allClass))
        {
          $classTable.=' <tr>
                    <td>'.$row["className"].'</td>
                    <td>'.$row["cdate"].'</td>
                    <td>'.$row["RDate"].'</td>
                    <td>'.$row["Status"].'</td>';
          
          // Get the current date and time
          $currentDateTime = new DateTime();
          // Add 48 hours to the current date and time
          $currentDateTime->add(new DateInterval('PT48H'));
          // Format the resulting date and time as a string
          $futureDate = $currentDateTime->format('Y-m-d');
          //echo "Date and time 48 hours after now: " . $futureDateTime;                    

          if($row['Status']=='Reserved' && $row['cdate']>$futureDate){
              $classTable.='<td><input type="hidden" name="userId" value="'.$row["classID"].'"/>';
              $classTable.="<button class='btn btn-danger' name='cancelClass' onclick=\"confirm('Are you want to cancel the class number  ".$row["bookID"]."') && cancelClass('".$row["bookID"]."')\">Cancel</button></td>";       
          }
          else{
            $classTable.='<td></td>';
          }
          $classTable.='</tr>';
        }
    }
    else 
    {
      $classTable.='<tr><td colspan="5" style="color:red;text-align:center;">No records are found </td></tr>';
    
    }
    $classTable.='</tbody>
    </table></div>';
    echo $classTable;
   }
 ?>

