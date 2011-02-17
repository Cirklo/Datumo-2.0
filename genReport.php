<?php 
require_once("session.php");
$user_id = startSession();
?>

<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/autoSuggest.css" rel="stylesheet" type="text/css">
<link href="css/tipTip.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="js/jquery.init.js"></script>

<script type="text/javascript" src="js/jquery.cookie.js.js"></script>
<script type="text/javascript" src="js/jquery.tipTip.js"></script>
<script type="text/javascript" src="js/reports.js"></script>
<script type="text/javascript" src="js/filters.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/cloneFieldset.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/autosuggest.js"></script>
<?php
/**
 * @author João Lagarto	/ Nuno Moreno
 * @copyright João Lagarto 2010
 * @version Datumo2.0
 * @license EUPL
 * @abstract page to generate dynamic reports
 */
error_reporting(1);

//includes
require_once(".htconnect.php");
require_once("resClass.php");
require_once("dispClass.php");
require_once("searchClass.php");
require_once("queryClass.php");
require_once("reportClass.php");

//call database class (handle connections)
$db = new dbConnection();
//call other classes
$report = new reportClass();

$report->reportCreator($user_id);

echo "<div id=displayRelations></div>";
echo "<div id=dispFields></div>";
echo "<div id=dispFeatures></div>";

echo "<input type=hidden id=multiple name=multiple value=0>";
echo "<input type=hidden id=multipleFields name=multipleFields value=0>";
echo "<form method=post name=submitForm>";
echo "<input type=hidden name=queryFields id=queryFields>";
echo "<input type=hidden name=queryTables id=queryTables>";
echo "<input type=hidden name=queryWhere id=queryWhere>";
echo "<input type=hidden name=queryOrder id=queryOrder>";
echo "<input type=hidden name=queryLimit id=queryLimit>";
echo "<input type=hidden name=queryGroup id=queryGroup>";
echo "<input type=hidden name=queryClauses id=queryClauses>";
echo "</form>";

?>