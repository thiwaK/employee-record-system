<?php

include("../include/db_connect.php");
include("../include/validate_login.php");

if (!in_array($usertype, $adminOnly)){
    echo json_encode(array("response" => 900, "message" => "Unauthorized."));
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input data
    $employee_number = mysqli_real_escape_string($db_connect, $_POST['employee_number']);
    $username = mysqli_real_escape_string($db_connect, $_POST['username']);
    $password = mysqli_real_escape_string($db_connect, $_POST['password']);
    $password2 = mysqli_real_escape_string($db_connect, $_POST['password2']);
    $password_new = mysqli_real_escape_string($db_connect, $_POST['password_new']);
    $accounttype = mysqli_real_escape_string($db_connect, $_POST['accounttype']);

    // Check if employee already exists
    $row = mysqli_query($db_connect, "SELECT * FROM users WHERE employee_number = '$employee_number' 
    AND username = '$username' AND accounttype = '$accounttype' ");

    if ($row->num_rows === 1) {
        // Employee does exist
        $result = mysqli_fetch_assoc($row);
        $hashed_password = base64_encode(password_hash($password_new, PASSWORD_DEFAULT));

        if(password_verify($password, base64_decode($result['password']))) {

            if ($password2 === $password_new){
                $sql = "UPDATE users 
                SET 
                    password = ?, 
                    accounttype = ?
                WHERE employee_number = ? AND username = ?";
        
                
                $stmt = $db_connect->prepare($sql);
                $stmt->bind_param(
                    "ssss",
                    $hashed_password,
                    $accounttype,
                    $employee_number,
                    $username
                );
        
                if ($stmt->execute()) {
                    echo json_encode(array("response" => 100, "message" => "Update user successfully."));
                } else {
                    echo json_encode(array("response" => 500, "message" => $stmt->error));
                }
        
                $stmt->close();
            } else {
                // Password is incorrect
                echo json_encode(array("response" => 400, "message" => "Incorrect Password."));
            }
            
            

        } else {
            // Password is incorrect
            echo json_encode(array("response" => 400, "message" => "Incorrect Password."));
        }
        
    } else {
        // Employee does not exists
        echo json_encode(array("response" => 400, "message" => "Record not exists."));
    }

} else {
    echo json_encode(array("response" => 900, "message" => "Invalid request method."));
}
?>
