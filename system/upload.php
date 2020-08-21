<?php 
session_start();

$user_id = $_SESSION["user_id"];


include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$timestamp = time(); 


/* Getting file name */
$ext = explode(".",$_FILES['file']['name'])[1]; 
$filename = $user_id."_".$timestamp.".".$ext; 


/* Location */
$location = "../files/images/".$filename; 
$uploadOk = 1; 
  
if($uploadOk == 0){ 
   echo 0; 
}

else{ 
   /* Upload file */
   if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){ 
     
   }else{ 
      echo 0; 
   } 
} 



$sql3= "update user_profile set profile_pic='".$filename."' where user_id=".$user_id;

$result3 = $conn->query($sql3);

echo $filename;


?> 