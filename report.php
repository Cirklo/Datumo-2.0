<?php 
require_once("session.php");
$user_id = startSession();
?>
<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/autoSuggest.css" rel="stylesheet" type="text/css">
<link href="css/CalendarControl.css" rel="stylesheet" type="text/css">
<link href="css/tipTip.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="js/jquery.init.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js.js"></script>
<script type="text/javascript" src="js/jquery.tipTip.js"></script>
<script type="text/javascript" src="js/CalendarControl.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/reports.js"></script>
<script type="text/javascript" src="js/filters.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/cloneFieldset.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ajax-autosuggest.js"></script>
<script type="text/javascript" src="js/ajax-dynamic-list.js"></script>


<?php

/**
 * @author João Lagarto	/ Nuno Moreno
 * @copyright João Lagarto 2010
 * @version Datumo2.0
 * @license EUPL
 * @abstract Report display
 */
error_reporting(1);

//browser detection
$browser = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
$browser = strstr($browser, "Chrome");

//includes
require_once (".htconnect.php");
require_once ("dispClass.php");
require_once ("queryClass.php");
require_once ("genObjClass.php");
require_once ("resClass.php");
require_once ("searchClass.php");
require_once ("reportClass.php");
require_once ("msgClass.php");

//call database class (handle connections)
$db = new dbConnection();
$engine = $db->getEngine();
//call other classes
$display = new dispClass();
$genObj = new genObjClass();
$perm = new restrictClass();
$search = new searchClass();
$report = new reportClass();
$mail = new mailClass();

//set variables
$contact = "Do you want to report a bug? Please submit the form.";

//initialize variables to build query
if(isset($_GET['report'])){
	$report_id = $_GET['report'];
	$nrows = 20; //default number of displayed results
	$sql = $report->loadQuery($report_id);
	//split string
	$fields = substr($sql,strlen("SELECT"),strpos($sql,"FROM")-strlen("SELECT"));
	$maxSql = substr($sql,0,strpos($sql,"LIMIT"));
	$where = strpos($sql,"WHERE");
	$group = strpos($sql,"GROUP BY");
	$order = strpos($sql,"ORDER BY");
	if(strpos($sql,"LIMIT")==""){ //if it is a dynamic report
		$sql .= " LIMIT 20 OFFSET 0";
	}	
	//ALL THE POSSIBILITIES TO CONSTRUCT THE QUERY -> SPLIT QUERY AND REARRANGE IT -> BIG FUC..... HACK
	if($where===false){
		$where="";
		if($group=="" and $order==""){
			$objName = substr($sql,strpos($sql,"FROM")+4, strpos($sql,"LIMIT")-strpos($sql,"FROM")-4);
			$group="";
			$order="";
		}else if($group=="" and $order!=""){
			$objName = substr($sql,strpos($sql,"FROM")+4, strpos($sql,"ORDER BY")-strpos($sql,"FROM")-4);
			$order = substr($sql,strpos($sql,"ORDER BY")+8, strpos($sql,"LIMIT")-strpos($sql,"ORDER BY")-8);
			$group="";
		}else if($group!="" and $order==""){
			$objName = substr($sql,strpos($sql,"FROM")+4, strpos($sql,"GROUP BY")-strpos($sql,"FROM")-4);
			$group = substr($sql,strpos($sql,"GROUP BY")+8, strpos($sql,"LIMIT")-strpos($sql,"GROUP BY")-8);
			$order="";
		} else {
			$objName = substr($sql,strpos($sql,"FROM")+4, strpos($sql,"GROUP BY")-strpos($sql,"FROM")-4);
			$group = substr($sql,strpos($sql,"GROUP BY")+8, strpos($sql,"ORDER BY")-strpos($sql,"GROUP BY")-8);
			$order = substr($sql,strpos($sql,"ORDER BY")+8, strpos($sql,"LIMIT")-strpos($sql,"ORDER BY")-8);	
		}
	} else {
		$objName = substr($sql,strpos($sql,"FROM")+4, strpos($sql,"WHERE")-strpos($sql,"FROM")-4);
		if($group=="" and $order==""){
			$where = substr($sql,strpos($sql,"WHERE")+5, strpos($sql,"LIMIT")-strpos($sql,"WHERE")-5);
			$group="";
			$order="";
		}else if($group=="" and $order!=""){
			$where = substr($sql,strpos($sql,"WHERE")+5, strpos($sql,"ORDER BY")-strpos($sql,"WHERE")-5);
			$order = substr($sql,strpos($sql,"ORDER BY")+8, strpos($sql,"LIMIT")-strpos($sql,"ORDER BY")-8);
			$group="";
		}else if($group!="" and $order==""){
			$where = substr($sql,strpos($sql,"WHERE")+5, strpos($sql,"GROUP BY")-strpos($sql,"WHERE")-5);
			$group = substr($sql,strpos($sql,"GROUP BY")+8, strpos($sql,"LIMIT")-strpos($sql,"GROUP BY")-8);
			$order="";
		} else {
			$where = substr($sql,strpos($sql,"WHERE")+5, strpos($sql,"GROUP BY")-strpos($sql,"WHERE")-5);
			$group = substr($sql,strpos($sql,"GROUP BY")+8, strpos($sql,"ORDER BY")-strpos($sql,"GROUP BY")-8);
			$order = substr($sql,strpos($sql,"ORDER BY")+8, strpos($sql,"LIMIT")-strpos($sql,"ORDER BY")-8);
		}
	}
	
	
} else {
	if(isset($_POST['queryFields']))	$fields = $_POST['queryFields'];
	if(isset($_POST['queryTables']))	$tables = $_POST['queryTables'];
	if(isset($_POST['queryWhere']))		$where = $_POST['queryWhere'];
	if(isset($_POST['queryOrder']))		$order = $_POST['queryOrder'];
	if(isset($_POST['queryGroup']))		$group = $_POST['queryGroup'];
	if(isset($_POST['queryLimit']))		$nrows = $_POST['queryLimit'];
	if(isset($_POST['queryClauses']))	$clauses = $_POST['queryClauses'];
}

//get current page number
if(isset($_GET['page'])) { //page to be shown
	$pageNum = $_GET['page'];	
} else {
	$pageNum = 1; //default page to be shown
}

//handle post array if this is a dynamic report submit
if(isset($_GET['d'])){
	$i=0; //initialize counter
	foreach($_POST as $value){
		$where = str_replace("&$i", $value, $where);
		$i++; //increment counter
	}
}

//validating the query
if(!isset($report_id) and !isset($_GET['page'])){	
	$objName="";
	$tables=explode(",",$tables);
	for($i=0;$i<sizeof($tables);$i++) {
		$tables[$i] = $db->getDatabase().".".$tables[$i].",";
		$objName .= $tables[$i];
	}
	$objName = substr($objName,0,strlen($objName)-1);
} else {
	if(isset($_GET['page'])){ $objName=$tables; }
}

//other variables
$offset = ($pageNum - 1) * $nrows; //counting the offset 

//hidden content
echo "<form method=post name=submitForm>";
echo "<input type=hidden name=queryFields id=queryFields value='".$fields."'>";
echo "<input type=hidden name=queryTables id=queryTables value='".$objName."'>";
echo "<input type=hidden name=queryWhere id=queryWhere value='".$where."'>";
echo "<input type=hidden name=queryOrder id=queryOrder value='".$order."'>";
echo "<input type=hidden name=queryLimit id=queryLimit value='".$nrows."'>";
echo "<input type=hidden name=queryGroup id=queryGroup value='".$group."'>";
echo "<input type=hidden name=queryClauses id=queryClauses value='".$clauses."'>";
echo "</form>";

//validating the query
if($where!="") $where = " WHERE ".$where;
if($order!="") $order = " ORDER BY ".$order;
if($group!="") $group = " GROUP BY ".$group;

//BUILDING THE QUERY
$sql = "SELECT $clauses $fields FROM $objName $where $group $order LIMIT $nrows OFFSET $offset";
$_SESSION['sql']=$sql;
$report->setQuery($sql);
//test query for errors
$report->testQuery();
//call method to calculate the maximum number of rows from the main query
$numRows = $report->maxRows("SELECT $clauses $fields FROM $objName $where $group $order");

//page navigator
//get the last page according to the number of rows displayed in the page
$maxPage = ceil($numRows/$nrows);
// print the link to access each page
$self = $_SERVER['PHP_SELF'];
// creating previous and next link
// plus the link to go straight to
// the first and last page

if ($pageNum > 1){
   $page  = $pageNum - 1;
   $prev  = " <a href=javascript:void(0) class=exp onclick=submitReport($page)>[Prev]</a> ";//\"$self?table=$table&nrows=$nrows&order=$order&colOrder=$colOrder&page=$page\">[Prev]</a> ";
   $first = " <a href=javascript:void(0) class=exp onclick=submitReport(1)>[First Page]</a> "; //\"$self?table=$table&nrows=$nrows&order=$order&colOrder=$colOrder&page=1\">[First Page]</a> ";
} else {
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
   $first = '&nbsp;'; // nor the first page link
}
	
if ($pageNum < $maxPage){
   $page = $pageNum + 1;
   $next = " <a href=javascript:void(0) class=exp onclick=submitReport($page)>[Next]</a> ";
   $last = " <a href=javascript:void(0) class=exp onclick=submitReport($maxPage)>[Last Page]</a> ";
} else {
   $next = '&nbsp;'; // we're on the last page, don't print next link
   $last = '&nbsp;'; // nor the last page link
}

//main table
$options=array("Options","Report");
echo "<table border=0>";
$display->options($options);
echo "<tr>";
//table to display user options
echo "<td valign=top>";
echo "<table border=0 align=left width=200px>";
$display->userOptions(false, $user_id, $contact);
echo "<tr><td><a href=javascript:void(0) class=contact>Report bug</a>";
$display->contactForm();
echo "</td></tr>";
echo "<tr><td><hr></td></tr>";
// reports
if(isset($report_id))	echo "<tr><td><a href=excel.php?report=$report_id title='Export data to xls file'>Export data</a></td></tr>";
echo "<tr><td><a href=javascript:void(0) onclick=saveReport($user_id)>Save Report</a></td></tr>";
$display->reportOptions(false, $user_id);
echo "</table>";
echo "</td>";

echo "<td valign=top>";
//display page navigator

echo "<table class=main border=0>";
//call method to display attribute headers
$report->displayHeader($fields);
$report->displayResults();
echo "</table>";
echo "<table border=0>";
echo "<tr><td>".$first.$prev." Showing page $pageNum of $maxPage pages ".$next.$last."</td></tr>"; 
echo "</table>";
echo "</td>";
echo "</tr>";
echo "</table>";


?>