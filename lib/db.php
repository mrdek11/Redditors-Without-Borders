<?
mysql_connect("localhost","rwb","rwbpass");
mysql_select_db("rwb");
function Query($query){
	$query = mysql_query($query) or die(mysql_error());
	return $query;
}
?>
