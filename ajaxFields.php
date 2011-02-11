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
require_once("reportClass.php");
*/

//set local variables
$header = array();

//call classes to handle database connection and to build queries for different engines
$conn = new dbConnection();
$display = new dispClass();
$engine = $conn->getEngine();
$database = $conn->getDatabase();

//change database to information schema
$conn->dbInfo();

if(isset($_GET['type'])){ $type = $_GET['type']; }

switch($type){
	case 0:
		//variables
		$arrTables=array();
		$arr=array();
		$fullarr=array();
		
		//http variables
		if(isset($_GET['table0'])){ $arrTables[] = $_GET['table0'];}
		if(isset($_GET['table1'])){ $arrTables[] = $_GET['table1'];}
		
		echo "<table>";
		echo "<tr><td>Number of rows to be displayed per page</td><td><input type=text id=nrows name=nrows size=1 value=20></td></tr>";		
		echo "<tr><td>Use DISTINCT clause</td><td><input type=checkbox name=distinct id=distinct></td></tr>";
		echo "</table>";
		
		echo "<form name=fieldDisp>";
		echo "<table border=1>";
		for($j=0;$j<sizeof($arrTables);$j++){
			$display->tableHeaders($arrTables[$j]);
			$fullarr = $display->getFullHeader();
			$fk = $display->getFKeys();
			$arr=$display->getHeader();
			echo "<tr>";
			echo "<td colspan=2>Select the attributes you want to display from the table <b>$arrTables[$j]</b>:</td>";
			echo "<td>Order By</td>";
			echo "<td>Group By</td>";
			echo "</tr>";
			for($i=0;$i<sizeof($arr);$i++){
				echo "<tr>";
				echo "<td width=25px><input type=checkbox name=$fullarr[$i] id=$fullarr[$i]></td><td style='text-align:left'>$arr[$i]</td>";
				echo "<td style='text-align:center'><input type=checkbox name=order_$fullarr[$i] id=order_$fullarr[$i]></td>";
				echo "<td style='text-align:center'><input type=checkbox name=group_$fullarr[$i] id=group_$fullarr[$i]></td>";
				if($fk[$fullarr[$i]]!=""){
					$lang="__fk";
					$class="fk";
				} else {
					$lang="";
					$class="reg";
				}
				echo "<td><input type=text id=value_$fullarr[$i] name=value_$fullarr[$i] lang='$lang' class='$class' alt=''></td>";
				echo "</tr>";
			}
			
		}
		echo "<tr><td colspan=2><input type=button name=proceed id=proceed value='Build query' onclick=buildQuery()></td></tr>";
		echo "</table>";
		echo "</form>";
		break;
	case 1:
		
		break;
}



?>