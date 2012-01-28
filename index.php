<?php
session_start();
include("lib/db.php");
include("lib/rwb-class.php");
$rwb = new RWB();


if(isset($_GET['logout'])){
	session_destroy();
	session_start();
}
if(isset($_POST['form'])){
	$form = $_POST['form'];
	if($form == "login")
		$rwb->handleLogin();
	if($form == "registration")
		$rwb->handleRegistration();
}

?>
<html>
	<head>
		<title>Redditors Without Borders</title>
	</head>
	<body>
		<?php $rwb->displayHeader() ?>
		<div align='center'>
			<h1>redditors without borders</h1><br /><br />
			<h2><a href="http://www.Reddit.com/r/RWB">We are developing our site. Meanwhile, please join us on Reddit</a></h2>

		</div>
		<br /><br /><br /><br />
		<div class="social" align='center'>
			<a href="http://www.facebook.com/pages/Redditors-Without-Borders/353038971381560" target='_BLANK'><img class="logo" src="images/facebook.jpg" /></a>
				
			<a href="https://twitter.com/#!/RedditWB" target='_BLANK'><img class="logo" src="images/twitter.jpg" /></a>
		</div>
	</body>
</html>
