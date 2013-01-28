<?php
/// REMOVE MOVIES THAT ARE REPORTED
/// VISIT: http://yourwebsite.com/remove.php?id=X&p=YOURPASSWORD
require('mysql.php');
$id = $_GET['id'];
$pword = $_GET['p'];
if($pword == REMOVEPASSWORD){
	mysql_query("UPDATE `imdb` SET reported='1' WHERE id=$id") or die(mysql_error());
	echo "$id has been removed";
}else{
	die('Password was wrong');
}
?>