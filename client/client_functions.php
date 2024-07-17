<?php

include("../include/functions.php");
// ----- Cancel Reserved Class -----------------------------------------------------
if(isset($_POST['reserveClassCancel'])){
  $bookID = $_POST['bookID'];
  $userId = $_SESSION['loggedUserId'];

  $query_class = "select * from reserved where bookID='$bookID'";
  $reserved  = mysqli_query($con, $query_class);
  if(mysqli_num_rows($reserved)>0)
  {  
    if($row=mysqli_fetch_assoc($reserved))
    {
      $classID = $row['classID'];
      $update_query = "UPDATE classroom SET booker = '' where classID = '$classID'";
      mysqli_query($con,$update_query);
      $update_query = "UPDATE reserved SET Status = 'Cancelled' where bookID = '$bookID'";
      mysqli_query($con,$update_query);
      $update_query = "UPDATE users_details SET Credit = Credit + 1 where UserId = '$userId'";
      mysqli_query($con,$update_query);

      $msg = "Cancel reserved class successfull!";
      $error = "";
      $sendData = array(
          "msg" => $msg,
          "error" => $error
      );
      echo json_encode($sendData);
    }
  }
}

// -------Reserving Class------------------------------
if(isset($_POST['classname'])){
  $classname = $_POST['classname'];
  $cdate = $_POST['cdate'];

  $userId = $_SESSION['loggedUserId'];
  $classID = 0;
  $RDate = date('Y-m-d');
  
  $query_class = "select * from classroom where className='$classname' AND cdate='$cdate'";
  $class  = mysqli_query($con, $query_class);
  if(mysqli_num_rows($class)>0)
  {  
    if($row=mysqli_fetch_assoc($class))
    {
      $classID = $row['classID'];
      $del = "Delete From reserved Where classID='$classID' And userID='$userId'";
      mysqli_query($con,$del);
      $reg="INSERT into reserved (classID, userID, RDate, Status) values('$classID','$userId','$RDate','Reserved')";
      mysqli_query($con,$reg);
      $update_query = "UPDATE classroom SET booker = '$userId' where classID = '$classID'";
      mysqli_query($con,$update_query);
      $update_query = "UPDATE users_details SET Credit = Credit - 1 where UserId = '$userId'";
      mysqli_query($con,$update_query);
      header("location:class.php");
    }
  }
}
// ----------------------------------------- Account Action -----------------------------------------------
//update the datals of user table

if(isset($_POST['updateAccount'])){
             
  $user_id = mysqli_real_escape_string($con, $_POST['updateAccount']);
  $firstname = mysqli_real_escape_string($con, $_POST['firstName']);
  $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $address = mysqli_real_escape_string($con, $_POST['address']);  

  // profile image upload
  $profileImageName = $_FILES["profileImage"]["name"];
  $tempname = $_FILES["profileImage"]["tmp_name"];   
  $folder = "../assets/picture/profiles/".$profileImageName;
       

  // $re_pass = base64_encode(mysqli_real_escape_string($conn, $_POST['reg_pass']));

  $User_details="SELECT * FROM users_details WHERE (Firstname='$firstname' OR Email='$email') AND UserId <> ' $user_id '";
  $result=mysqli_query($con,$User_details)or die("can't fetch");
  $num=mysqli_num_rows($result);


  $sendData = array();
 
  
 if ($firstname == "admin") {
      $error="Invalid Username (You cannot use the username as admin!)";
      $sendData = array(
          "msg"=>"",
          "error"=>$error
      );
      echo json_encode($sendData);
  } 
 else if ($num>0) {
      $error="Username or email id is already taken!";
      $sendData = array(
          "msg"=>"",
          "error"=>$error
      );
      echo json_encode($sendData);
  } else {

                  // query validation
                  $update="UPDATE users_details SET  FirstName='$firstname', LastName ='$lastname',Email='$email',Address='$address',ProfileImage='$profileImageName' where UserId = '$user_id'" ;


                  if(mysqli_query($con,$update))
                  {
                      if(!move_uploaded_file($tempname, $folder)){
                      //if(false){
                          $error ="Error in Updation ...! Try after sometime";
                          $sendData = array(
                              "msg"=>"",
                              "error"=>$error
                          );
                          echo json_encode($sendData);
                      }else{
                        $message = "User details updated";
                        // message("user.php","User Added");
                        $sendData = array(
                          "msg"=>$message,
                          "error"=>""
                      );
                      echo json_encode($sendData);
                      }
                  }
                  else{
                        $error ="Error in Updation ...! Try after sometime";
                        $sendData = array(
                          "msg"=>"",
                          "error"=>$error
                      );
                      echo json_encode($sendData);

                }

           
      
 }

}

// -------------------------------- Change password -----------------------------------

if(isset($_POST["oldPassword"])){
  $old = $_POST['oldPassword'];
  $new = $_POST['newPassword'];
  $ID = $_POST['change_password'];

  $Q = "SELECT * FROM users_details Where UserId = '$ID'";
  $res = mysqli_query($con,$Q);
  $row = mysqli_fetch_assoc($res);
  $num = mysqli_num_rows($res);

 
  $sendData = array();
  if($num>0){

      if($old == $row['Password']){
          $Q_update = "UPDATE users_details us SET us.Password = '$new' Where UserId = '$ID'";
          $result = mysqli_query($con,$Q_update);
          $msg = "Password Changed";
          $sendData = array(
              "msg"=>$msg,
              "error"=>""
          );
      }else{
          $error ="Oops! Wrong Old Password";
          $sendData = array(
            "msg"=>"",
            "error"=>$error
        );
      }
  }else{

      $error ="Invalid User ID ";
      $sendData = array(
        "msg"=>"",
        "error"=>$error
    );
  }
echo json_encode($sendData);
}
?>