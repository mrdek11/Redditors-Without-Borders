<?
mysql_connect("localhost","rwb","rwbpass") or die(mysql_error());
mysql_select_db("rwb") or die(mysql_error());
function Query($query){
	$query = mysql_query($query) or die(mysql_error());
	return $query;
}
?>
