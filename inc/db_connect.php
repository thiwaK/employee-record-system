<?php
$mysql_hostname = "localhost:3306";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "emp_nrmc";

$db_connect = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or ("Could not connect database");

?>