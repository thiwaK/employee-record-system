<?php
$mysql_hostname = "localhost:3306";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "emp_nrmc";



$db_connect = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or ('ERROR: Could not connect to database');

?>