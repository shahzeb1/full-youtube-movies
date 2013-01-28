<?php
define(MYSQLHOST, 'localhost');
define(MYSQLUSERNAME, 'root');
define(MYSQLPASSWORD, 'root');
define(MYSQLDB, 'movies');
define(REMOVEPASSWORD, 'meow69'); //PASSWORD FOR REMOVING MOVIES


mysql_connect(MYSQLHOST, MYSQLUSERNAME, MYSQLPASSWORD) or die(mysql_error());
mysql_select_db(MYSQLDB) or die(mysql_error());

?>
