<?php
require_once("session.php");
$user_id = startSession();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/autoSuggest.css" rel="stylesheet" type="text/css">
<link href="css/CalendarControl.css" rel="stylesheet" type="text/css">
<link href="css/tipTip.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/jquery.alert.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="js/jquery.init.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js.js"></script>
<script type="text/javascript" src="js/jquery.tipTip.js"></script>
<script type="text/javascript" src="js/jquery.alert.js"></script>
<script type="text/javascript" src="js/jquery.project.js"></script>
<script type="text/javascript" src="js/jqBarGraph.js"></script>
<script type="text/javascript" src="js/CalendarControl.js"></script>
<script type="text/javascript" src="js/filters.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/cloneFieldset.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<?php

/** @author João Lagarto
 * @copyright João Lagarto 2010
 * @version Requisition System 2.0
 * @license EUPL
 * @abstract Script to handle baskets depending on the basket type
 */
error_reporting(1);

//includes
require_once (".htconnect.php");
require_once ("dispClass.php");
require_once ("queryClass.php");
require_once ("genObjClass.php");
require_once ("resClass.php");
require_once ("reportClass.php");
require_once ("mailClass.php");
require_once ("treeClass.php");
require_once ("configClass.php");
require_once ("requisitionsClass.php");
require_once "projectClass.php";

//call database class (handle connections)
$db = new dbConnection();
$engine = $db->getEngine();
//call other classes
$display = new dispClass();
$genObj = new genObjClass();
$perm = new restrictClass();
$search = new searchClass();
$treeview = new treeClass();
$mail = new mailClass();
$config = new configClass();
$req = new reqClass();
$project = new projectClass();

//set local variables 
$arr = array();

//display menus
$options=array("Options","Basket Management");
echo "<table border=0>";
$display->options($options);
echo "<tr>";
echo "<td valign=top>";
echo "<table border=0 align=left width=200px>";
$display->userOptions(true,$user_id);
echo "<tr><td><a href=javascript:void(0) class=contact>Report bug</a>";
$display->contactForm();
echo "</td></tr>";
echo "<tr><td><hr></td></tr>";
echo "<tr><td><a href=admin.php title='Return to the administration area'>Return to main menu</a></td></tr>";
//echo "<tr><td><a href=excel.php?table=$table title='Export data to xls file'>Export data</a></td></tr>";
// reports
$display->reportOptions(true,$user_id);
//display treeview
echo "<tr><td><a href=javascript:void(0) title='Tree reports'>Treeview reports</a>";
echo "<div id='treeList' class=sidebar>";
$treeview->treeview_access($user_id);
echo "</div>";
echo "</td></tr>";
$config->checkPlugins();
echo "</table>";
echo "</td>";
echo "<td valign=top>";
echo "Project management";
$project->projects($user_id);
echo "<div id=projectInfo lang=exp></div>";
echo "<br>";
echo "<div id=projectGraph lang=exp></div>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<div id=graph lang=exp></div>";
?>