<?php

$tag_id    = $_GET['tag_id'];
$time      = date('M d Y h:i:s A');
$reader_id = $_GET['reader_id'];

//replace USER and PASSWORD with your username and password
$con mysql_connect("localhost","rfid","rfid");
if(!$con){
die('Could not connect: ' . mysql_error());
}

$query1 = INSERT INTO `rfid`.`rfid` (
`tag` ,
`time` ,
`rid`
)
VALUES (
'test2', 'test2', 'test2'
);

// Because the version of php I am using won't let me figure out the time in milliseconds
// we will sometimes get the same tag read multiple times in the same second, which would
// normally cause the database to complain that it's unique constraint is being violated
// for the tre table.  So we're going to check to see if that tag has been seen in this second
// before we try to update the database
//$query1 = "SELECT * FROM rfid WHERE tag = '$tag_id' AND time = TIMESTAMP '$time' AND rid = $reader_id";
//$result1 = pg_query($query1) or die ('Query failed: ' . pg_last_error());

// The database will also complain if we try to add a tag read for a tag that's not in
// the tags table, so let's check for that too
//$query2 = "SELECT * FROM tag WHERE tag_id = '$tag_id'";
//$result2 = pg_query($query2) or die ('Query failed: ' . pg_last_error());

// If we only got part of the tag id (and it does happen, if you move the tag away from the
// reader fast, we don't want to add it to the database either.  So let's check to see that
// the length of the tag id is 10
//if(!pg_fetch_row($result1) && strlen($tag_id) == 10 && pg_fetch_row($result2)) {
//	$query3 = "INSERT INTO rfid VALUES ('$tag_id', TIMESTAMP '$time', $rid)";
//	pg_query($query3) or die('Query failed: ' . pg_last_error());
//}

//$query4 = "DELETE FROM tres WHERE time < now() - interval '5 minutes'";
//pg_query($query4) or die ('Query failed: ' . pg_last_error());

mysq_close($con)

?>
