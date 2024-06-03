<?php

include("../include/db_connect.php");
include("../include/validate_login.php");

if (!in_array($usertype, $adminOnly)){
    echo json_encode(array("response" => 900, "message" => "Unauthorized."));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_number = mysqli_real_escape_string($db_connect, $_POST['employee_number']);
    $username = mysqli_real_escape_string($db_connect, $_POST['username']);
    $account_type = mysqli_real_escape_string($db_connect, $_POST['account_type']);
    
    // Check if employee and user already exists
    $emp_numb = mysqli_query($db_connect, "SELECT employee_number FROM employees WHERE employee_number = '$employee_number'");
    $user_numb = mysqli_query($db_connect, "SELECT employee_number FROM users WHERE username = '$username' AND accounttype = '$account_type' AND employee_number = '$employee_number'");

    if ($emp_numb->num_rows === 1 && $user_numb->num_rows === 1) {
        // User exists. Delete!
        $sql = "DELETE FROM users WHERE employee_number = '$employee_number' AND username = '$username' AND accounttype = '$account_type'";
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
