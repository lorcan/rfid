<html>
<head>
<title>PHP Test</title>
</head>
<body>

<?php
$user_name="rfid";
$password="rfid";
$database="rfid";
$server="localhost";

$tag_id    = $_GET['tag_id'];
$time      = date('M d Y h:i:s A');
$reader_id = $_GET['reader_id'];

$db_handle=mysql_connect($server,$user_name,$password);
$db_found=mysql_select_db($database,$db_handle);

if($db_found){
	print "Database found<br />";

	$query2 = "INSERT INTO `rfid`.`rfid` (`tag` ,`time` ,`rid`)VALUES ('$tag_id', '$time', '$reader_id');";
	mysql_query($query2);
	
	$SQL = "SELECT * FROM rfid";
	$result = mysql_query($SQL);
	
	while ($db_field = mysql_fetch_assoc($result)){
	print $db_field["tag"];
	print $db_field["time"];
	print "<br />";
	}

	while ($db_field2 = mysql_fetch_assoc($result2)){
	print $db_field2["item"];
	}

	mysql_close(db_handle);
}else{
	print "Database not found";
	mysql_close(db_handle);
}

?>

</body>
</html>
