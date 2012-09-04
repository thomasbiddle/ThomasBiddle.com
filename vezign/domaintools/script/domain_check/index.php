<?php
error_reporting(E_ALL);
include("../lib/DomainTools.php");
$DomainTools = new Base_DomainTools();

if(isset($_POST['btntest']) && isset($_POST['txtdomain'])){
	$domain_array = array();
	foreach($_POST as $name => $value){
		if($name != "btntest" && $name != "txtdomain"){
			$domain_array[] = $value;
		}
	}
	if(count($domain_array) > 0){
		$result = $DomainTools->Free($_POST['txtdomain'], $domain_array);
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Domain check example</title>
</head>
<body>
<?php 
if(isset($result)){ 
	if(is_array($result)){
	foreach($result as $extension => $check){
		if($check){
			echo "<strong>" . $_POST['txtdomain'] . "." . $extension . " is free</strong><br />";
		}else{
			echo $_POST['txtdomain'] . "." . $extension . " is  not free<br />";
		}
	}
	}else{
		if($result){
			echo "<strong>" . $_POST['txtdomain'] . "." . $domain_array[0] . " is free</strong><br />";
		}else{
			echo $_POST['txtdomain'] . "." . $domain_array[0] . " is  not free<br />";
		}
	}
}else{
?>
<form id="form1" name="form1" method="post" action="">
<label>Domain</label>
  <p>
    <input type="text" name="txtdomain" id="txtdomain" />
    <br />
    <?php 
$domain_list = $DomainTools->GetExtensionList();

foreach($domain_list as $domain){
	echo '<label for="chk' . $domain . '">' . $domain . '</labej><input type="checkbox" value="' . $domain . '" name="chk' . $domain . '" value="' . $domain . '" id="chk' . $domain . '" /><br />';
}

?>
</p>
  <p>
    <input type="submit" name="btntest" id="btntest" value="Test" />
</p>
</form>
<?php } ?>
</body>
</html>