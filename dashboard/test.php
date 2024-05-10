<?php
include("../inc/header.php");

$limit = 10;
$get_emp_quary = "SELECT * FROM employee ORDER BY employee_id DESC LIMIT $limit";
$unitname;

echo">>>>>>>>>>>>>>>>>>".$usertype."<<<<<<<<<<<<<<<<<<<";

if($usertype == "Admin"){
    $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee LIMIT $limit");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];

} else if($usertype=="superuser")	{
    $query = $db_connect->query("SELECT userunit  FROM users WHERE username='$username'");
    $result = $query->fetch_assoc();
    $unitname = $result['division_name'];
    
    $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee 
    INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
    INNER JOIN users ON units_of_etc.unit_name=users.userunit
    WHERE employee.unit='$unitname'");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];
}

?>