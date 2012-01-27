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
		<style>
			a { text-decoration: none; color:#000000; }
			a:hover { text-decoration: underline; }
		</style>
	</head>
	<body>
		<div align='right'>
			<?php $rwb->displayHeader(); ?>
		</div>
		<div align='center' style='padding-top:20px'>
			<img src='images/logo.png' />
			<h2 style='color:#ff4400;'>We are developing our site, please <a href="http://www.Reddit.com/r/RWB">Join Us at Reddit</a></h2>
			<h2 style='color:#ff4400;'>BE THE CHANGE YOU WANT TO SEE</h2>
		</div>	
		<div class="social">
			<a href="http://www.facebook.com/pages/Redditors-Without-Borders/353038971381560"><img class="logo" src="images/facebook.jpg" /></a>
				
			<a href="https://twitter.com/#!/RedditWB"><img class="logo" src="images/twitter.jpg" /></a>
		</div>
	</body>
</html>
