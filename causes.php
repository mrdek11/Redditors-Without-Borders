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
		<title>Redditors Without Borders - Causes</title>
	</head>
	<body>
		<?php $rwb->displayHeader() ?>
		<div align='center'>
			<h1>RWB Causes</h1>
		<?php $rwb->showCauses() ?>

			

		</div>
		<br /><br /><br /><br />
	</body>
</html>
