<?php

require_once ".htconnect.php";
//get user id so specific query can be built
require_once "session.php";
$user_id=startSession();
	
//call database class
$conn=new dbConnection();
	
//initialize variables
try{
	/*$query="SELECT task_id, action_name, task_description, task_date, user_login
  	FROM task, action, user
  	WHERE action_id=task_action
  	AND task_user=user_id";*/
	$query="SELECT entry_id, resource_name, entry_datetime, DATE_ADD( entry_datetime, INTERVAL entry_slots * resource_resolution MINUTE ) AS entry_time, user_login, color_code
		FROM entry, resource, user, color
		WHERE entry_user=user_id
		AND entry_resource=resource_id
		AND resource_color=color_id
		AND entry_status IN (1,2)
		AND (entry_user=$user_id 
		OR resource_resp=$user_id)";
	if(isset($_GET['ids'])){
		$arr=$_GET['ids'];
		$query.=" AND resource_id IN ($arr)";
	}
	
  	$sql=$conn->query($query);
	//loop through all results
	for($i=0;$row=$sql->fetch();$i++) {
	   	//build message to be displayed
	   	$json[$i]["id"]=$i+1;
	   	$json[$i]["title"]=$row[1].": ".$row[4];
	   	$json[$i]["start"]=$row[2];//$row[3];
	   	$json[$i]["end"]=$row[3];//$row[3];
	   	$json[$i]["allDay"]=false;
	  	$json[$i]["color"]="#".$row[5];
	   	
	}
} catch(Exception $e){
   	echo $e->getMessage();
}

//need to print to json format
//print_r($ret);
echo json_encode($json);




?>

