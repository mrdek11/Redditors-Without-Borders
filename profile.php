<?php
session_start();
include("lib/db.php");
include("lib/rwb-class.php");
$rwb = new RWB();

if(isset($_POST['email']))
	$rwb->handleProfileUpdate();

$rwb->displayHeader();


$query = Query("select * from Users where id='{$_SESSION['userID']}}' limit 1;");
$user = mysql_fetch_object($query);

echo "<div align='center'>";
	echo "<table>";
		echo "<form action='profile.php' method='post'>";
			echo "<tr><td style='font-weight:bold'>Username:</td><td>$user->Username (<b>$user->Rank</b>)</td></tr>";
			echo "<tr><td style='font-weight:bold'>Email:</td><td><input type='text' name='email' value=\"$user->Email\"</td></tr>";
			echo "<tr><td valign='top' style='font-weight:bold'>Assets:</td><td><textarea name='assets' rows=5 cols=40>$user->Assets</textarea></td></tr>";
			echo "<tr><td><input type='submit' value='Update' /></td></tr>";
		echo "</form>";
	echo "</table>";
echo "</div>";

?>
