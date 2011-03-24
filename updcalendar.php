<?php
require_once ".htconnect.php";
$conn=new dbConnection();

$conn->beginTransaction();
$sql=$conn->query("SELECT user_id FROM user WHERE user_level=2 AND user_id<>87");
//loop through all users
for($i=0;$row=$sql->fetch();$i++){
	try{
		//$sql_add=$conn->query("UPDATE admin SET admin_permission=1 WHERE admin_user=$row[0]");
		//$sql_add=$conn->query("INSERT INTO admin (admin_user,admin_table, admin_permission) VALUES ($row[0],'permissions',0)");
		$sql_add=$conn->query("INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES ($row[0],'user','user_id',$row[0])");
	}catch(Exception $e) {
		echo $e->getMessage();
	}
	
	// admin (admin_user,admin_table, admin_permission) VALUES ($row[0],'user',5)");
	//
	//
}
$conn->commit();

echo "Finished";