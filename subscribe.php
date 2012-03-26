<?php
session_start();
include("lib/db.php");

$userID = $_SESSION['userID'];
if(preg_match("|link_(.*)|",$_GET['id'],$regs)){
	$id = $regs[1];
}else{
	exit;
}
$sub = ($_GET['sub'] == 'true') ? true : false;

if($sub){
	$query = Query("insert into Subscriptions (CauseID,UserID,Timestamp) values ('$id','$userID',unix_timestamp());");
}else{
	$query = Query("delete from Subscriptions where CauseID='$id' and UserID='$userID';");
}
?>
