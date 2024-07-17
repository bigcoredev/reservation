
<?php

include('../include/functions.php');

// ---------------------------------------User Actions----------------------------------------------

   // Adding New User into Database
    if(isset($_POST['firstname'])){
             
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address = mysqli_real_escape_string($con, $_POST['address']);  
        $credit = mysqli_real_escape_string($con, $_POST['credit']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($con, $_POST['conformPassword']);

    
        // profile image upload
        $profileImageName = "avatar.jpg";
        if($_FILES["profileImage"]["name"]){
            $profileImageName = $_FILES["profileImage"]["name"];
            $tempname = $_FILES["profileImage"]["tmp_name"];   
            $folder = "../assets/picture/profiles/".$profileImageName;
        }
    
        // $re_pass = base64_encode(mysqli_real_escape_string($conn, $_POST['reg_pass']));
    
        $User_details="SELECT * FROM users_details WHERE Firstname='$firstname' OR Email='$email'";
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
        } else if ($num>0) {
            $error="Username or email id is already taken!";
            $sendData = array(
                "msg"=>"",
                "error"=>$error
            );
            echo json_encode($sendData);
        } else {
    
            $number = preg_match('@[0-9]@', $password);
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
           
            // if(strlen($password) < 3 || !$number || !$uppercase || !$lowercase || !$specialChars) {
    
             //password validation 
    
              if(strlen($password) < 3) {
                    $error = "Password must be at least 3 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
                    $sendData = array(
                        "msg"=>"",
                        "error"=>$error
                    );
                    echo json_encode($sendData);
              }else{
    
                  if($password!=$confirmPassword){
                        $error = "Invalid password and confirm password !";
                        $sendData = array(
                            "msg"=>"",
                            "error"=>$error
                        );
                        echo json_encode($sendData);
                  }else{
    
                        // query validation
                        $insert="insert into users_details (FirstName,LastName,Email,Password,Address,Credit,ProfileImage) values('$firstname','$lastname','$email','$password','$address','$credit','$profileImageName') " ;

    
                        if(mysqli_query($con,$insert))
                        {
                            if($profileImageName!="avatar.jpg"){
                                if(!move_uploaded_file($tempname, $folder)){
                                //if(false){
                                    $error ="Error in Registration ...! Try after sometime";
                                    $sendData = array(
                                        "msg"=>"",
                                        "error"=>$error
                                    );
                                    echo json_encode($sendData);
                                }
                            }
                            else{
                                $message = "User Added";
                                // message("user.php","User Added");
                                $sendData = array(
                                    "msg"=>$message,
                                    "error"=>""
                                );
                                echo json_encode($sendData);
                            }
                        }
                        else{
                              $error ="Error in Registration ...! Try after sometime";
                              $sendData = array(
                                "msg"=>"",
                                "error"=>$error
                            );
                            echo json_encode($sendData);
                        }
    
                  }
              }
            
       }

    }
    
// delete of user account
if(isset($_POST['deleteUser'])){
    $user_id = mysqli_real_escape_string($con, $_POST['userId']);
    $query_deleteUser = "Delete from users_details where UserId = '$user_id' ";
    $sendData = array();
    if(mysqli_query($con,$query_deleteUser)){
        $sendData = array(
            "msg"=>"User is Deleted",
            "error"=>""
        );
        echo json_encode($sendData);
    }else{
        $error = "User Has a booking";
        $sendData = array(
            "msg"=>"",
            "error"=>$error
        );
        echo json_encode($sendData);
    }
}

//update - getting the selected user details
if(isset($_POST['userUpdateId'])){
    $userID = $_POST['userUpdateId'];
   
    $query_selectUser = "select * from users_details where UserId = '$userID' ";
    $single_user = mysqli_query($con,$query_selectUser);
    $num_of_rows = mysqli_num_rows($single_user);
    $response = array();
    if($num_of_rows<1){
        $response['status'] = 200;
        $response['message'] = "invalid user id";
    }else{
        while($row = mysqli_fetch_assoc($single_user)){
            $response = $row;
        }
    }
    echo json_encode($response);
}


//update the datails of user table

if(isset($_POST['updateUserID'])){
             
    $user_id = mysqli_real_escape_string($con, $_POST['updateUserID']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);  
    $credit = mysqli_real_escape_string($con, $_POST['credit']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
   
    // profile image upload
    $profileImageName = "";
    if($_FILES["profileImage"]["name"]){
        $profileImageName = $_FILES["profileImage"]["name"];
        $tempname = $_FILES["profileImage"]["tmp_name"];   
        $folder = "../assets/picture/profiles/".$profileImageName;
    }         

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
                if($profileImageName)    
                    $update="UPDATE users_details SET  FirstName='$firstname', LastName ='$lastname',Email='$email',Address='$address',Credit='$credit',Status='$status',ProfileImage='$profileImageName' where UserId = '$user_id'" ;
                else
                    $update="UPDATE users_details SET  FirstName='$firstname', LastName ='$lastname',Email='$email',Address='$address',Credit='$credit',Status='$status' where UserId = '$user_id'" ;

                    if(mysqli_query($con,$update))
                    {
                        if($profileImageName && !move_uploaded_file($tempname, $folder)){
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

// --------------------------------------- Class Action ----------------------------------------

//add new type of class
if(isset($_POST['classname'])){

    $className = $_POST['classname'];
    $people =  $_POST['people'];
    $zone =  $_POST['zone'];
    $location = $_POST['location'];
    $cdate =  $_POST['cdate'];
    $ctime =  $_POST['ctime'];
    $duration =  $_POST['duration'];

    $insert_query = "insert into classroom(className,people,zone,location,cdate,ctime,duration) values('$className','$people','$zone','$location','$cdate','$ctime','$duration')";
       
    if(mysqli_query($con,$insert_query)){
        $message = "Class is Added";
        $sendData = array(
            "msg"=>$message,
            "error"=>""
        );
    }
    else{
        $error ="Error in Adding ...! Try after sometime";
        $sendData = array(
            "msg"=>"",
            "error"=>$error
        );
    }
    echo json_encode($sendData);
}

// delete - delete class
if(isset($_POST['deleteRoom'])){
    $roomId = $_POST['roomId'];
    $query_deleteRoom = "Delete from classroom where classID = '$roomId' ";
    $sendData = array();
    if(mysqli_query($con,$query_deleteRoom)){
        $sendData = array(
            "msg"=>"This Class is Deleted",
            "error"=>""
        );
        echo json_encode($sendData);
    }
}

//update - getting the selected class details
if(isset($_POST['roomUpdateId'])){
    $roomUpdateId = $_POST['roomUpdateId'];
   
    $query_type =  "SELECT * FROM classroom WHERE classID=".$roomUpdateId;
    $single_type = mysqli_query($con,$query_type);
    $num_of_rows = mysqli_num_rows($single_type);
    $response = array();
    if($num_of_rows<1){
        $response['status'] = 200;
        $response['message'] = "invalid user id";
    }else{
        while($row = mysqli_fetch_assoc($single_type)){
            $response = $row;
        }
    }
    echo json_encode($response);
}

//update the details of class table
if(isset($_POST['updateRoomId'])){
             
    $updateRoomId = $_POST['updateRoomId'];
    $className = $_POST['editclassname'];
    $people = $_POST['editpeople'];
    $zone = $_POST['editzone'];
    $location = $_POST['editlocation'];
    $ctime = $_POST['edittime'];
    $duration = $_POST['editduration'];
    $cdate = $_POST['editdate'];
     
            
    // query validation
    $update="UPDATE classroom SET ctime=$ctime,duration=$duration,cdate='$cdate',location='$location', zone='$zone',className='$className',people='$people' where classID = '$updateRoomId'" ;
        
        
    if(mysqli_query($con,$update))
    {
                       
        $message = "Class details updated";
        $sendData = array(
            "msg"=>$message,
            "error"=>""
        );
    }
    else{
        $error ="Error in Updation ...! Try after sometime update";
        $sendData = array(
            "msg"=>"",
            "error"=>$error
        );
        
    }
    echo json_encode($sendData);
}


// ---------------------------------------------- Contact Actions ------------------------------------

// delete of contact
if(isset($_POST['deleteContact'])){
    $id = mysqli_real_escape_string($con, $_POST['ID']);
    $query_deleteUser = "Delete from contact where ID = '$id' ";
    $sendData = array();
    if(mysqli_query($con,$query_deleteUser)){
        $sendData = array(
            "msg"=>"Detail is Deleted",
            "error"=>""
        );
        echo json_encode($sendData);
    }else{
        $error = "Error in Deleting, Try After Sometimes";
        $sendData = array(
            "msg"=>"",
            "error"=>$error
        );
        echo json_encode($sendData);
    }
}
// ----------------------------------- Account ---------------------------------------


//update the datals of user table

if(isset($_POST['updateAccount'])){
             
    $user_id = mysqli_real_escape_string($con, $_POST['updateAccount']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $address = mysqli_real_escape_string($con, $_POST['address']);  

    // profile image upload
    $profileImageName = $_FILES["profileImage"]["name"];
    $tempname = $_FILES["profileImage"]["tmp_name"];   
    $folder = "../assets/picture/profiles/".$profileImageName;
         

                    // query validation
                    $update="UPDATE users_details SET  LastName ='$lastname',Address='$address',ProfileImage='$profileImageName' where UserId = '$user_id'" ;


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

// -------------------------------- General Setting-----------------------------------------

if(isset($_POST["generalSettings"])){
   

    $Q = "SELECT * FROM general_settings ";
    $res = mysqli_query($con,$Q);
    $row = mysqli_fetch_assoc($res);

    $sendData =array();
    if($row){
        $sendData = $row;
    }else{
        $error ="Invalid User ID ";
        $sendData = array(
          "msg"=>"",
          "error"=>$error
      );
    }

    echo json_encode($sendData);
}

if(isset($_POST['companyName'])){
    $companyName = $_POST['companyName'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $Country = $_POST['country'];
    $zip = $_POST['zip'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $teleNumber = $_POST['teleNumber'];
    $gs_id = $_POST['gs_id'];

   

    $Q = "SELECT * FROM general_settings Where ID = '$gs_id'";
    $res = mysqli_query($con,$Q);
    $row = mysqli_fetch_assoc($res);
    $num = mysqli_num_rows($res);
  
   
    $sendData = array();
    if($num>0){

        $Q_update = "UPDATE general_settings SET Name = '$companyName',Address_line1 = '$address1',Address_line2 = '$address2',
                     City = '$City', State = '$State', Country = '$Country', Zip_code = '$zip',Description = '$description',
                     Email = '$email',Phone_number = '$phoneNumber', Telephone_Number = '$teleNumber'
                     Where ID = '$gs_id'";
      
        if(mysqli_query($con,$Q_update)){
            $msg = "Company Details has been saved";
            $sendData = array(
                "msg"=>$msg,
                "error"=>""
            );
        }else{
            $error ="Oops! Error in Updation";
            $sendData = array(
              "msg"=>"",
              "error"=>$error
          );
        }
    }else{

        $error ="Invalid ID ";
        $sendData = array(
          "msg"=>"",
          "error"=>$error
      );
    }
 echo json_encode($sendData);

}


// ----- Cancel Reserved Class -----------------------------------------------------
if(isset($_POST['reserveClassCancel'])){
    $bookID = $_POST['bookID'];
  
    $query_class = "select * from reserved where bookID='$bookID'";
    $reserved  = mysqli_query($con, $query_class);
    if(mysqli_num_rows($reserved)>0)
    {  
      if($row=mysqli_fetch_assoc($reserved))
      {
        $classID = $row['classID'];
        $userId = $row['userID'];
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
  
?>
