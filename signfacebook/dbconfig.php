<?php

define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'stopoint_usr432');    // DB username

define('DB_PASSWORD', 'axvRN~NATFnB');    // DB password

define('DB_DATABASE', 'stopoint_db1');      // DB name

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");

$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");

?>