<?php

include("../inc/db_connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_number = mysqli_real_escape_string($db_connect, $_POST['employee_number']);
    
    // Check if employee already exists
    $emp_numb = mysqli_query($db_connect, "SELECT employee_number FROM employees WHERE employee_number = '$employee_number'");

    if ($emp_numb->num_rows === 1) {
        // Employee exists. Delete!
        $sql = "DELETE FROM employees WHERE employee_number = '$employee_number'";
        if ($db_connect->query($sql) === TRUE) {
            echo json_encode(array("response" => 100, "message" => "Record deleted successfully."));
        } else {
            echo json_encode(array("response" => 500, "message" => $db_connect->error));
        }

    } else {
        // Employee does not exists
        echo json_encode(array("response" => 400, "message" => "Record not found."));
    }

    $db_connect->close();
} else {
    echo json_encode(array("response" => 900, "message" => "Invalid request method."));
}
?>
