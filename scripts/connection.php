<?php 
    $db_host = "localhost";

// Place the username for the MySQL database here

    $db_username = "root"; 

// Place the password for the MySQL database here

    $db_password = ""; 

// Place the name for the MySQL database here

    $db_name = "debug";

// Run the connection here 
    mysql_connect("$db_host","$db_username","$db_password") or die (mysql_error());
    mysql_select_db("$db_name") or die ("no database named "+$db_name+" exists!");

?>