<?php

	$to      = 'puppywoodpetresort@gmail.com';
	
	$name = $_GET['name'];
	$email = $_GET['email'];
	$address = $_GET['address'];
	$number = $_GET['number'];
	$petname = $_GET['petname'];
	$petbreed = $_GET['petbreed'];
	$gender = $_GET['gender'];
	$fixedstatus = $_GET['fixedstatus'];
	$vetname = $_GET['vetname'];
	$vetphone = $_GET['vetphone'];
	$arrivaldate = $_GET['arrivaldate'];
	$departdate = $_GET['departdate'];
	$meds = $_GET['meds'];
	$feeding = $_GET['feeding'];
	$grooming = $_GET['grooming'];
	$other = $_GET['other'];
	
	
	$subject = 'NEW CUSTOMER Information & Booking';

	$headers = 'From: PuppywoodApp@Puppywood.com' . "\r\n";
	$headers .= 'Reply-To: noreply@Puppywood.com' . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message = '<html><body>';
	$message .= '<b>Sent from the Puppywood App</b><br>';
	$message .= "<br>Full Name: " . $name;
	$message .= "<br>Phone Number: " . $number;
	$message .= "<br>Email: " . $email;
	$message .= "<br>Address: " . $address;
	$message .= "<br><br>Arrival Date: " . $arrivaldate;
	$message .= "<br>Departure Date: " . $departdate;
	$message .= "<br><br>Pet Name: " . $petname;
	$message .= "<br>Pet Breed: " . $petbreed;
	$message .= "<br>Gender: " . $gender;
	$message .= "<br>Fixed Status: " . $fixedstatus;
	$message .= "<br><br>Vets Name: " . $vetname;
	$message .= "<br>Vets Phone: " . $vetphone;
	$message .= "<br><br>Medication Details: " . $meds;
	$message .= "<br>Feeding Details: " . $feeding;
	$message .= "<br>Grooming: " . $grooming;
	$message .= "<br>Other Notes: " . $other;
	$message .= '</body></html>';

	if (!empty($name)) // Just a quick check to make sure someone didn't accidently visit the page via a browser and trigger the script.
		mail($to, $subject, $message, $headers);
	
?>