<?php

/**
 * @author Joao Lagarto
 * @abstract Script to handle mail ajax requests
 */

/*** Type list
 * 1 - Contact to report bug
 * 
 * 
 * 
 * 
 */

require_once (".htconnect.php");
require_once ("mailClass.php");

if(isset($_GET['type'])) $type = $_GET['type'];

switch ($type){
	case 1:
		$mail = new mailClass();
		$refMail = "jlagarto@igc.gulbenkian.pt"; //where the mails go to (only bug reports)
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = nl2br($_POST['message']);
		//get todays date
		$todayis = date("l, F j, Y, g:i a") ;
		//set a title for the message
		$subject = "Datumo 2.0 Bug Report";
		$body = "From $name, \n\n$message";
		//put your email address here
		$str=$mail->sendMail($subject, $refMail, $email, $body);
		echo $str;
		break;
}








?>
