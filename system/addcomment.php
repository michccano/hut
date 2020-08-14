<?php
session_start();
error_reporting("E_ALL");

$id = $_SESSION["user_id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "huddleup";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if($_POST["text"]){
$sql = "insert into huddleup_comments (post_id,description,commenter_id) values ('".$_POST["id"]."','".$_POST["text"]."','".$id."')";
$result = $conn->query($sql);
}


$comments = array();

$sql3= "SELECT * from huddleup_comments where post_id=".$_POST["id"];

$result3 = $conn->query($sql3);



if ($result3->num_rows > 0) {

while($row3 = $result3->fetch_assoc()) 
{

$commenter_name = "";


$sql4= "SELECT * from user_profile where user_id=".$row3["commenter_id"];

$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {

while($row4 = $result4->fetch_assoc()) 
{
$commenter_name  = $row4["full_name"];
}

}

array_push($comments,array("text"=>$row3["description"],"full_name"=>$commenter_name));




}

}

echo json_encode($comments);

?>