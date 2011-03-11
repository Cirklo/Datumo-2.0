<link href="css/index.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/tipTip.css" rel="stylesheet" type="text/css">
<link href="css/jquery.alert.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="js/jquery.init.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js.js"></script>
<script type="text/javascript" src="js/jquery.tipTip.js"></script>
<script type="text/javascript" src="js/jquery.alert.js"></script>
<script type="text/javascript" src="js/jquery.functions.js"></script>

<?php

require_once (".htconnect.php");

//call database class
$db = new dbConnection();

//title the page
echo "<title>Datumo 2.0 :: Open Source Database Management</title>";
//initialize main container
echo "<div class=main lang=exp>";
//initialize header
echo "<div class=header lang=exp>";
echo "<div class=title lang=exp>";
echo "<div class=logo lang=exp><img src=pics/cirklo.png title='Collecting and developing a set of open source tools for lab management optimization'></div>";
echo "<div class=desc lang=exp></div>";
echo "</div>";
echo "<div class=login lang=exp>";
echo "<div id=errorNotify ></div>";
//Login form containers
echo "<table>";
echo "<tr><td>";
echo "<table border=0 align=left>";
echo "<tr><td colspan=2><hr></td></tr>";
echo "<tr><td>Username</td><td><input type=text name=user_login id=user_login></td></tr>";
echo "<tr><td>Password</td><td><input type=password name=user_passwd id=user_passwd></td></tr>";
echo "<tr><td colspan=2 style='text-align:right'><a href=javascript:void(0) onclick=$(document).recoverPwd() class=exp>Recover password</a>&nbsp;&nbsp;<input type=button id=login value=Login onclick=$(document).login();></td></tr>";
echo "<tr><td colspan=2><hr></td></tr>";
echo "</table>";
echo "</td></tr>";
echo "<tr><td>";
echo "<a href=javascript:void(0)>Information</a>";
echo "<div id=info style='display:none;position:absolute'>";
echo "<table class=informations align=left>";
echo "<tr><td><b>Engine</b></td><td>".$db->getEngine()."</td></tr>";
echo "<tr><td><b>Database</b></td><td>".$db->getDatabase()."</td></tr>";
echo "<tr><td><b>Description</b></td><td>".$db->getDescription()."</td></tr>";
echo "<tr><td><br></td></tr>";
echo "<tr><td><b>Version</b></td><td>Datumo 2.0</td></tr>";
echo "<tr><td><b>Contact</b></td><td><a href=mailto:".$db->getAdmin().">".$db->getAdmin()."</a></td></tr>";

echo "</table>";
echo "</td></tr>";
echo "</table>";
echo "</div>"; 
echo "</div>";//end of header div
echo "</div>";//end of main container
?>