<?php

require_once ("mailClass.php");

class errorClass{
	private $mail;
	
	
	public function __construct(){
		$this->mail = new mailClass();		
	}

/**
 * method to display the error in a div
 * @param string $sql
 * @param string $objName
 * @param string $error PDO exception
 * @param string $msg
 */

	public function errorDisplay($sql,$objName,$error,$msg){
		echo "<div id=error class=error>$msg</div>";
		$this->sendReport($sql, $error, $objName);
		exit();
	}
	
/**
 * method to report the error through email
 * @param string $sql
 * @param string $objName 
 * @param string $error PDO exception
*/
	
	public function sendReport($sql,$error,$objName){
		//guy who will receive the error report
		$to = "jlagarto@igc.gulbenkian.pt";
		//report subject
		$subject = "Datumo 2.0 Error Report";
		$msg="Error Report\n\n";
		$msg.="Error occurred at ".date("D, d M Y H:i:s")."\n";
		$msg.="Query: $sql\n";
		$msg.="PDO: $error";
		//generate message to report the error
		$this->mail->sendMail($subject, $to, $from, $msg);	
		
	}
	
	
	
}

?>