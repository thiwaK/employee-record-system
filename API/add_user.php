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
    $password = mysqli_real_escape_string($db_connect, $_POST['password']);
    $accounttype = mysqli_real_escape_string($db_connect, $_POST['accounttype']);

    // Check if user already exists
    $emp_numb = mysqli_query($db_connect, "SELECT username FROM users WHERE username = '$username' ");

    if ($emp_numb->num_rows === 0) {
        // Employee does not exist, insert into database
        $hashed_password = base64_encode(password_hash($password, PASSWORD_DEFAULT));

        $sql = "INSERT INTO users (username, password, accounttype, employee_number)
                VALUES (?, ?, ?, ?)";
        
        $stmt = $db_connect->prepare($sql);
        $stmt->bind_param(
            "ssss",
           
            $username,
            $hashed_password,
            $accounttype,
            $employee_number,
        );

        if ($stmt->execute()) {
            echo json_encode(array("response" => 100, "message" => "User added successfully."));
        } else {
            echo json_encode(array("response" => 500, "message" => $stmt->error));
        }

        $stmt->close();
    } else {
        // Employee exists
        echo json_encode(array("response" => 400, "message" => "Record already exists."));
    }

    $db_connect->close();
} else {
    echo json_encode(array("response" => 900, "message" => "Invalid request method."));
}
?>
