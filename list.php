<?php
session_start();
$link = "http://" . $_SERVER['SERVER_NAME'] . "/follow?twitter_id=" . $_SESSION['twitter_id'];
?>
<!DOCTYPE html>
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
		</nav>
	</section>
	<section>
		<p>
			Your friends are now ready to be shared! Give the link below to your friends!
		</p>
		<div>
			<pre>
				<?php echo $link; ?>
			</pre>
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