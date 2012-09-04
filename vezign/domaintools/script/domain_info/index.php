<?php
include("../lib/DomainTools.php");
$DomainTools = new Base_DomainTools();

// Check if domain is valid
if(isset($_POST['site'])) $domain = htmlspecialchars($_POST['site']);
$error = true;
if(isset($domain)){

	$error = false;
	
	$parts = explode(".", $domain);
	array_pop($parts);
	$name = implode(".", $parts);
	
	$free = $DomainTools->Free($name, array("nl", "info", "net", "com", "org"));
	$ranks = $DomainTools->Rank($domain);
	$indexed = $DomainTools->IndexedPages($domain);
	$backlinks = $DomainTools->Backlinks($domain);
	$whois = $DomainTools->Whois($domain);
	$keywords = $DomainTools->Keywords($domain);
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DomainTools</title>
<link href="style.css" rel="stylesheet" />
</head><body>
<div id="wrapper">
  <div id="maincontent">
  <h1>Domain Info</h1>
  <h2 id="toc">What domain do you want to check?</h2>
  <form action="" method="post">
  	<input name="site" id="site" />
    <button>Get Info</button>
  </form>
<p></p>
<?php if(isset($domain)){ ?>
<h2>Report for <?php echo $domain; ?></h2>
      <div class="divexample">
      <div class="item">
      	<h3>Domain check</h3>
        <?php 
			foreach($free as $extension => $status){
				$string_status =  ($status) ? "Available" : "Taken";
				echo ".<strong>" . $extension . "</strong>: " . $string_status;
				if($string_status == "Available") echo ' - <a href="http://www.securepaynet.net/domains/searchresults2.aspx?prog_id=theinternetco&d=' . $name . '.' . $extension . '">Register</a>';
				echo '<br />';
			}
		 ?>
      </div>
    </div>
    <div class="divexample">
      <div class="item">
        <h3>Rank check</h3>
        <?php 
			echo "<strong>Google Pagerank:</strong> " . $ranks['google'] . "<br />";
			echo "<strong>Alexa Pagerank:</strong> " . $ranks['alexa'] . "<br />";
			echo "<strong>Alexa Delta:</strong> " . $ranks['alexa_delta'] . "<br />";
		?>
      </div>
    </div>
    <div class="divexample">
      <div class="item">
        <h3>Indexed pages</h3>
        <?php
			echo "<strong>Google:</strong> " . $indexed['google'] . "<br />";
			echo "<strong>Bing:</strong> " . $indexed['bing'] . "<br />";
			echo "<strong>Yahoo:</strong> " . $indexed['yahoo'] . "<br />";
		?>
      </div>
    </div>
    <div class="divexample">
      <div class="item">
        <h3>Backlinks</h3>
        <?php 
			echo "<strong>Google:</strong> " . $backlinks['google'] . "<br />";
			echo "<strong>Yahoo:</strong> " . $backlinks['yahoo'] . "<br />";
		?>
      </div>
    </div>
    <div class="divexample">
      <div class="item">
        <h3>Keywords check</h3>
        <?php 
			echo "<ul>";
			foreach($keywords as $keyword){
				echo "<li>" . $keyword . "</li>";
			}
			echo "</ul>";
		?>
      </div>
    </div>
    <div class="divexample">
      <div class="item">
        <h3>Whois information</h3>
        <?php echo "<code>" . nl2br($whois) . "</code>"; ?>
      </div>
    </div>
    <?php } ?>
    </div>
</div>
</body></html>
