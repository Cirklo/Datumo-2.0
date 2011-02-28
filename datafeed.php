<?php

/**
 *	For now this script is prepared to run with update, delete and insert features although these are disbled 
 * 	Currently this only works as a visualization tool.
 * 
 * 	Should we enable these features? If so, need to be careful about
 * 	-	Overlapping
 * 	-	multiple resource check
 * 	-	Entry check
 * 
 * 	-	Maybe we need to create a separate table to handle this
 */

require_once ".htconnect.php";
require_once "calFunctions.php";

/**
 * This method is not used because dynamic insert is disabled 
 */

function addCalendar($st, $et, $sub, $ade){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "insert into `jqcalendar` (`subject`, `starttime`, `endtime`, `isalldayevent`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."' )";
    //echo($sql);
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] = mysql_insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

/**
 * This method is not used because dynamic insert is disabled 
 */

function addDetailedCalendar($st, $et, $sub, $ade, $dscr, $loc, $color, $tz){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "insert into `jqcalendar` (`subject`, `starttime`, `endtime`, `isalldayevent`, `description`, `location`, `color`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($color)."' )";
    //echo($sql);
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] = mysql_insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function listCalendarByRange($sd, $ed){
	//get user id so specific query can be built
	require_once "session.php";
	$user_id=startSession();
	
	//call database class
	$conn=new dbConnection();
	
	//initialize variables
 	$ret = array();
  	$ret['events'] = array();
  	$ret["issort"] =true;
  	$ret["start"] = php2JsTime($sd);
  	$ret["end"] = php2JsTime($ed);
  	$ret['error'] = null;
  	try{
  		//set query to get all database entries for this user    
  		//we want to display all entries from this user and all entries for this user resources
	    $query = "SELECT entry_id, resource_name, entry_datetime, user_login, status_name, entry_comments, DATE_ADD(entry_datetime, INTERVAL entry_slots*resource_resolution MINUTE) as entry_endtime, entry_comments, entry_action, resource_color 
	    FROM entry, resource, user, status 
	    WHERE resource_id=entry_resource
	    AND entry_status=status_id
	    AND entry_user=user_id 
	    AND entry_datetime BETWEEN '".php2MySqlTime($sd)."' AND '". php2MySqlTime($ed)."'
	    AND entry_status IN (1,2,4)
	    AND (resource_resp=$user_id OR entry_user=$user_id)";
	    $sql=$conn->prepare($query);
	    $sql->execute();
	    //loop through all results
	    for($i=0;$row=$sql->fetch();$i++) {
	    	//build message to be displayed
	    	$msg=$row["resource_name"].": <b>".$row["user_login"]."</b><br>";
	    	$msg.="Entry status: <b>".$row["status_name"]."</b><br><br>";
	    	$msg.=$row["entry_comments"];
	      	$ret['events'][] = array(
	        	$row["entry_id"], //entry identification
	        	$msg, //message to be displayed in the calendar
	        	php2JsTime(mySql2PhpTime($row["entry_datetime"])), 	//start time
	        	php2JsTime(mySql2PhpTime($row["entry_endtime"])),	//end time
	        	0,	//feature not used
	        	0, 	//more than one day event
	        	0,	//Recurring event
	        	$row["resource_color"],	//color (not used for now)
	        	0,	//editable
	        	"", //location (not used)
	        	""	//$attends
	      	);
	    }
	} catch(Exception $e){
    	echo $e->getMessage();
  	}
  	//print_r($ret);
	return $ret;
}

function listCalendar($day, $type){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      break;
  }
  //echo $st . "--" . $et;
  return listCalendarByRange($st, $et);
}

/**
 * This method is not used because dynamic update is disabled 
 */

function updateCalendar($id, $st, $et){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update `jqcalendar` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "' "
      . "where `id`=" . $id;
    //echo $sql;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

/**
 * This method is not used because dynamic update is disabled 
 */

function updateDetailedCalendar($id, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "update `jqcalendar` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "', "
      . " `subject`='" . mysql_real_escape_string($sub) . "', "
      . " `isalldayevent`='" . mysql_real_escape_string($ade) . "', "
      . " `description`='" . mysql_real_escape_string($dscr) . "', "
      . " `location`='" . mysql_real_escape_string($loc) . "', "
      . " `color`='" . mysql_real_escape_string($color) . "' "
      . "where `id`=" . $id;
    //echo $sql;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

/**
 * This method is not used because dynamic delete is disabled 
 */

function removeCalendar($id){
  $ret = array();
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "delete from `jqcalendar` where `id`=" . $id;
		if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}




header('Content-type:text/javascript;charset=UTF-8');
$method = $_GET["method"];
switch ($method) {
    case "add":
        $ret = addCalendar($_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["IsAllDayEvent"]);
        break;
    case "list":
        $ret = listCalendar($_POST["showdate"], $_POST["viewtype"]);
        break;
    case "update":
        $ret = updateCalendar($_POST["calendarId"], $_POST["CalendarStartTime"], $_POST["CalendarEndTime"]);
        break; 
    case "remove":
        $ret = removeCalendar( $_POST["calendarId"]);
        break;
    case "adddetails":
        $id = $_GET["id"];
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
        if($id){
            $ret = updateDetailedCalendar($id, $st, $et, 
                $_POST["Subject"], $_POST["IsAllDayEvent"]?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }else{
            $ret = addDetailedCalendar($st, $et,                    
                $_POST["Subject"], $_POST["IsAllDayEvent"]?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }        
        break; 


}
echo json_encode($ret); 



?>