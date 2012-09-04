<?php

	$to      = 'get.started@vezign.com';
	
	$name = $_GET['name'];
	$number = $_GET['number'];
	$email = $_GET['email'];
	$pages = $_GET['pages'];
	$platform= $_GET['platform'];
	$rebrand = $_GET['rebrand'];
	$cname = $_GET['cname'];
	$cindus = $_GET['cindus'];
	$cinfo = $_GET['cinfo'];
	$emailopt = $_GET['emailopt'];
	$smedia = $_GET['smedia'];
	$fbook = $_GET['fbook'];
	$twitter = $_GET['twitter'];
	$ecommerce = $_GET['ecommerce'];
	$seobasic = $_GET['seobasic'];
	$mobile = $_GET['mobile'];
	$tablet = $_GET['tablet'];
	$seomanage = $_GET['seomanage'];
	$blogmanage = $_GET['blogmanage'];
	$socialmanage = $_GET['socialmanage'];
	$tcost = $_GET['tcost'];
	
	$subject = 'Vezign App Quick Quote';

	$headers = 'From: VezignApp@Vezign.com' . "\r\n";
	$headers .= 'Reply-To: noreply@vezign.com' . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message = '<html><body>';
	$message .= '<b>Sent from the Vezign App</b><br>';
	$message .= "<br>Full Name: " . $name;
	$message .= "<br>Phone Number: " . $number;
	$message .= "<br>Email: " . $email;
	$message .= "<br><br>Number of Pages: " . $pages;
	$message .= "<br>Platform: " . $platform;
	$message .= "<br><br>Rebrand: " . $rebrand;
	$message .= "<br>Company Name: " . $cname;
	$message .= "<br>Company Industry: " . $cindus;
	$message .= "<br>Company Info: " . $cinfo;
	$message .= "<br><br><b>Additional Features</b>";
	$message .= "<br>Email Opt-In: " . $emailopt;
	$message .= "<br>Social Media Sharing: " . $smedia;
	$message .= "<br>Facebook Page Design: " . $fbook;
	$message .= "<br>Twitter Profile Design: " . $twitter;
	$message .= "<br>eCommerce Setup: " . $ecommerce;
	$message .= "<br>SEO Basic Setup: " . $seobasic;
	$message .= "<br>Mobile Version of Site: " . $mobile;
	$message .= "<br>Tablet Version of Site: " . $tablet;
	$message .= "<br><br><b>Reach Out:</b>";
	$message .= "<br>Monthly SEO Management: " . $seomanage;
	$message .= "<br>Monthly Blog Management: " . $blogmanage;
	$message .= "<br>Monthly Social Media Management: " . $socialmanage;
	$message .= "<br><br>Total Cost: " . $tcost;
	$message .= '</body></html>';

	mail($to, $subject, $message, $headers);
	
?>