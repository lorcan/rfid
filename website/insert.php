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
	
	$query1 = "SELECT * FROM tag WHERE id = '$tag_id'";
	$result1 = mysql_query($query1);
	
	if(strlen($tag_id) == 10 && mysql_fetch_row($result1)){
	$query2 = "INSERT INTO `rfid`.`rfid` (`tag` ,`item`) VALUES ('$tag_id', (SELECT item FROM tag WHERE id = '$tag_id'))";
	mysql_query($query2);
	}
	
	mysql_close(db_handle);
}else{
	print "Database not found";
	mysql_close(db_handle);
}

?>

</body>
</html>
