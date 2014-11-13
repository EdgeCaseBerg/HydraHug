<?php

/* Show status of current job */

if(!isset($_GET['job_id'])){
	die('Invalid Job Id');
}


include dirname(__FILE__) . '/twitteroauth/config.php';

$dblink = mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME, $dblink);
//inb4 SQL injection
$sql = "SELECT status,message FROM jobs WHERE job_id = \"" . mysql_real_escape_string($_GET['job_id']) . "\"";
$res = mysql_query($sql);
if(mysql_num_rows($res) == 0){
	die('No Job with that id exists');
}
$row = mysql_fetch_assoc($res);

mysql_close($dblink);
?><!DOCTYPE html>
<html>
<head>
	<title>Hydra Hug</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Hydra Hug</h1>
		<hr>
	</header>
	<section>
		<nav>
			<a href="https://github.com/EJEHardenberg/HydraHug">Source Code</a>
			<a href="/makelist.php">Make your list</a>
		</nav>
	</section>
	<section>
		<h2>The current status of your job is...</h2>
		<div>
			Status: <strong><?php echo $row['status']; ?></strong><br/>
			Message: <pre><?php echo $row['message']; ?></pre>
		</div>
	</section>
	<footer>
		<h3>Privacy and Data Policy</h3>
		<p>
			As you can see by the <a href="https://github.com/EJEHardenberg/HydraHug">Source Code</a>
			the application only saves the bare minimum of data to link the lists
			together and do its work.
		</p>
		<p>
			There are no plans to use your data in anyway besides the above specified
			besides possibly reporting how many people have used the application.
		</p>
		<p>
			The lists of who you follow will <strong>not</strong> be disclosed to 
			outside partys (who could just look at your twitter page anyway)
		</p>
	</footer>
</body>
</html>