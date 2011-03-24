<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link href="css/mycalendar/dailog.css" rel="stylesheet" type="text/css" />
<link href="css/mycalendar/calendar.css" rel="stylesheet" type="text/css" /> 
<link href="css/mycalendar/dp.css" rel="stylesheet" type="text/css" />   
<link href="css/mycalendar/alert.css" rel="stylesheet" type="text/css" /> 
<link href="css/mycalendar/main.css" rel="stylesheet" type="text/css" /> 
<link href="css/tipTip.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.4.4.js" type="text/javascript"></script>  
<script type="text/javascript">
$(document).ready(function(){
	$("#go").click(function(){
		//initialize array to store resource ids
		var arr=new Array;
		//initialize counter
		var counter=0;
		//go through all checked boxes
		$("input[type=checkbox]:checked").each(function(){
			arr.push(this.id);
			counter++;
		});
		if(counter==0){
			alert("You must select a valid number of resources to proceed");
			return;
		} else {
			window.parent.location="mycalendar.php?res="+arr;
		}
	
		
	});
});



</script>
<?php

/**
 * Script to choose resources to display in my calendar
 * 
 */

require_once ".htconnect.php";
require_once "session.php";
$user_id = startSession();

//call classes
$conn=new dbConnection();

//query the database for related resources
$sql=$conn->query("SELECT resource_id, resource_name FROM entry, resource WHERE resource_id=entry_resource AND (entry_user=$user_id OR resource_resp=$user_id) GROUP BY resource_name ORDER BY resource_name");
echo "<table>";
echo "<tr><td colspan=2><br></td></tr>";
//loop through all results
for($i=0;$row=$sql->fetch();$i++){
	echo "<tr><td>$row[1]</td><td><input type=checkbox id=$row[0] name=$row[0]></td></tr>";
}
//end table
echo "<tr><td colspan=2><br></td></tr>";
echo "<tr><td colspan=2><input type=button name=go id=go value=Submit></td></tr>";
echo "</table>";
?>