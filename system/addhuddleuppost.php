<?php
session_start();
error_reporting("E_ALL");


$team_id = $_SESSION["team_id"];



$id = $_SESSION["user_id"];

include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if($_POST["text"]){
$whn =  date("Y-m-d h:i:s");
$sql = "insert into huddleup_huddleup_posts (team_id,huddleup_id,description,op_user_id,typ,whn) values (".$team_id.",'".$_POST["id"]."','".$_POST["text"]."','".$id."',".$_POST["typ"].",'".$whn."')";

$result = $conn->query($sql);

}


$comments = array();

$sql3= "SELECT * from huddleup_huddleup_posts where team_id=1";

$result3 = $conn->query($sql3);


if ($result3->num_rows > 0) {

while($row3 = $result3->fetch_assoc()) 
{

$commenter_name = "";
$whn = $row3["whn"];

$arr = explode(" ",$whn)[0];
$arr1 = explode("-",$arr);

$tmp = $arr1[0]."-".$arr1[1]."-".$arr1[2];

$whn1 =  date("Y-m-d");
$dt = "";

if($tmp==$whn1){

$date1 = $whn;
$date2 =  date("Y-m-d h:i:s");
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);

$tmp1 = abs($timestamp2 - $timestamp1);

if($tmp1>=(60*60)){
	$dt = round(abs($timestamp2 - $timestamp1)/(60*60))." hours ago";
}



if($tmp1>=60){
	$dt = round(abs($timestamp2 - $timestamp1)/(60))." mins ago";
}

if($tmp1<60){
	$dt = abs($timestamp2 - $timestamp1)." seconds ago";
}


}








$sql4= "SELECT * from user_profile where user_id=".$row3["op_user_id"];

$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {

while($row4 = $result4->fetch_assoc()) 
{
$commenter_name  = $row4["full_name"];
}

}

array_push($comments,array("text"=>$row3["description"],"typ"=>$row3["typ"],"full_name"=>$commenter_name,"whn"=>$dt));

}

}

echo json_encode($comments);

?>