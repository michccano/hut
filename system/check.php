<?php

session_start();

include("config.php");


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}




//Get Huddle Ups////////////////
$hu_wn_replies = array();
$hu_w_replies = array();



$my_teams = array();

$sql3= "SELECT * from team_members where user_id=".$_SESSION["user_id"];

$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {

while($row3 = $result3->fetch_assoc()) 
{

array_push($my_teams,$row3["team_id"]);

}

}


$new_members = array();

foreach ($my_teams as $team) {


$sql3= "SELECT * from team_members where team_id=".$team." and user_id!=".$_SESSION["user_id"];

$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {

while($row3 = $result3->fetch_assoc()) 
{

$arr = explode(",",$row3["seen_by"]);

if(!in_array($_SESSION["user_id"],$arr)){

$sql4= "SELECT * from user_profile  where  user_id=".$row3["user_id"];

$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {

while($row4 = $result4->fetch_assoc()) 
{



}

}





$fnl = $row3["seen_by"].",".$_SESSION["user_id"];
$sql4= "update team_members set seen_by='".$fnl."' where id=".$row3["id"];

//$result4 = $conn->query($sql4);


array_push($new_members,array("team"=>$row3["team_id"],"member"=>$row3["user_id"]));


}


}

}




$sql45= "SELECT * from huddleup_huddleups where team_id=".$team;

$result45 = $conn->query($sql45);

if ($result45->num_rows > 0) {

while($row45 = $result45->fetch_assoc()) 
{

$arr = explode(",", $row45["seen_by"]);

if(!in_array($_SESSION["user_id"],$arr)){


$sql455 = "SELECT * from huddleup_comments where post_id=".$row45["id"];

$result455 = $conn->query($sql455);

if ($result455->num_rows <= 0) {
array_push($hu_wn_replies,array("title"=>$row45["title"]));
}

else{
array_push($hu_w_replies,array("title"=>$row45["title"]));
}



$fnl = $row45["seen_by"].",".$_SESSION["user_id"];

$sql4= "update huddleup_huddleups set seen_by='".$fnl."' where id=".$row45["id"];

//$result4 = $conn->query($sql4);



}



}

}






}




$final_nm = array();

foreach($new_members as $nm){

$team_name = "";
$full_name = "";


$sql4= "SELECT * from user_profile  where  user_id=".$nm["member"];

$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {

while($row4 = $result4->fetch_assoc()) 
{
$full_name = $row4["full_name"];


}

}


$sql4= "SELECT * from teams where id=".$nm["team"];

$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {

while($row4 = $result4->fetch_assoc()) 
{
$team_name = $row4["team_name"];


}

}


array_push($final_nm,array("team_name"=>$team_name,"member"=>$full_name));	

}






echo json_encode(array("final_m"=>$final_nm,"hu_wn_replies"=>$hu_wn_replies,"hu_w_replies"=>$hu_w_replies));

?>