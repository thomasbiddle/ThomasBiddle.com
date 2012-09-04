<?php
include("class.validate.php");

if(!empty($_POST['content'])) {

	$string = $_POST['content'];
	parse_str($string);

	$validate = new Validate;
	
	if($validate->setType("text")->setMinLength(2)->setMaxLength(50)->validateString($name) && $validate->setType("email")->validateString($email) && $validate->setType("text")->setMinLength(2)->setMaxLength(10000)->validateString($message)) {
	
		$receiver = "biddle.thomas@gmail.com";
		$subject = "ThomasBiddle.com - Website - Contactform";
		
		$header  = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type: text/html; charset=utf-8" . "\r\n";
		$header .= "From: " . $name . " <" . $email . ">";
		
		$message = nl2br($message);
		
		mail($receiver, $subject, $message, $header);
		
		echo "pass";
	
	} else { echo "fail"; }

}
?>