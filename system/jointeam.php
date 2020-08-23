<?php

session_start();

include("config.php");


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$sql3= "SELECT * from teams where keyident='".$_POST["keyident"]."'";

$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {

$ti = 0;
while($row3 = $result3->fetch_assoc()) 
{

$ti = $row3["id"];
}



$sql3= "SELECT * from team_members where user_id=".$_SESSION["user_id"];

$result3 = $conn->query($sql3);

if ($result3->num_rows <= 0) {


$sql3= "insert into team_members(team_id,user_id) values (".$ti.",".$_SESSION["user_id"].")";

$result3 = $conn->query($sql3);
echo json_encode(array("message"=>"success"));
}

else{
	echo json_encode(array("message"=>"already"));
}




}

else{
	echo json_encode(array("message"=>"Invalid"));
}


?>