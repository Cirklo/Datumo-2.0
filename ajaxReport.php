<?php
require_once("session.php");
$user_id = startSession();
/**
 * @author João Lagarto	/ Nuno Moreno
 * @abstract Ajax handler request -> get referenced table
 * 
 *  */

require_once(".htconnect.php");
require_once("dispClass.php");
/*
require_once("queryClass.php");
require_once("resClass.php");
require_once("searchClass.php");
require_once ("reportClass.php");
*/
//variables
$header = array();

//call classes to handle database connection and to build queries for different engines
$conn = new dbConnection();
//$query = new queryClass();
$display = new dispClass();
//$report = new reportClass();
$engine = $conn->getEngine();
$database = $conn->getDatabase();

//http variables
if(isset($_GET['user_id'])){	$user_id = $_GET['user_id'];}
if(isset($_GET['name'])){		$reportName = $_GET['name'];}
if(isset($_GET['desc'])){ 		$reportDescription = $_GET['desc'];}
if(isset($_GET['conf'])){ 		$conf = $_GET['conf'];}
$query = $_SESSION['sql'];
$_SESSION['sql']=null;

$sql = $conn->prepare("SELECT * FROM report WHERE report_name='$reportName' and report_user=$user_id");
$sql->execute();

if($sql->rowCount()==0){//Everything's ok to proceed with the save
	$sql = $conn->prepare("INSERT INTO report (report_name, report_description, report_query, report_user, report_conf) VALUES ('$reportName','$reportDescription','$query',$user_id,$conf)");
	try{
		//echo $sql->queryString;
		$sql->execute();
		echo "Query successfully saved!";
	} catch (Exception $e){
		echo "Error on saving the query!";
		echo $e;
	}
} else {
	echo "Report name already exists!";
}



?>