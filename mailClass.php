<?php

require_once "mail/class.phpmailer.php";
require_once ".htconnect.php";

class mailClass extends PHPMailer{
	private $pdo;
	
	public function __construct(){
		$this->pdo = new dbConnection();
		//set search path to main database
		$this->pdo->dbConn();
		$sql = $this->pdo->prepare("SELECT mainconfig_host, mainconfig_port, mainconfig_password, mainconfig_email, mainconfig_smtpsecure, mainconfig_smtpauth FROM ".$this->pdo->getDatabase().".mainconfig WHERE mainconfig_id = 1");
		$sql->execute();
		$row = $sql->fetch();
		$this->IsSMTP(); // telling the class to use SMTP
        $this->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
        $this->SMTPAuth   = $row[5];                  // enable SMTP authentication
        $this->SMTPSecure = $row[4];                 // sets the prefix to the servier
        $this->Port       = $row[1];                   // set the SMTP port for the GMAIL server   
        $this->Host       = $row[0];      		// sets GMAIL as the SMTP server
        $this->Username   = $row[3];  			// GMAIL username
        $this->Password   = $row[2];            // GMAIL password
    }
	
	/**
 * Method to send emails
 * @param unknown_type $contact
 */
	
	public function sendMail($subject, $to, $from, $msg){
		$this->SetFrom($from, $from);
        $this->AddReplyTo($from,$from);
		$this->Subject = $subject;
        $this->Body = $msg;
        $this->AddAddress($to, "");
		if(!$this->Send()) {
            //mail error
            return "Could not send mail!";
        } else {
            //mail OK
        	return "Mail successfully sent!";   
        }
	}
}


?>