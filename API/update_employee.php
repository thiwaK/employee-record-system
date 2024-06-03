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
    $name_with_initials = mysqli_real_escape_string($db_connect, $_POST['name_with_initials']);
    $name_denoted_initials = mysqli_real_escape_string($db_connect, $_POST['name_denoted_initials']);
    $date_of_birth = mysqli_real_escape_string($db_connect, $_POST['date_of_birth']);
    $nic = mysqli_real_escape_string($db_connect, $_POST['nic']);

    $permanent_address = mysqli_real_escape_string($db_connect, $_POST['permanent_address']);
    $postal_address = mysqli_real_escape_string($db_connect, $_POST['postal_address']);
    $email = mysqli_real_escape_string($db_connect, $_POST['email']);
    $phone_office = mysqli_real_escape_string($db_connect, $_POST['phone_office']);
    $phone_mobile = mysqli_real_escape_string($db_connect, $_POST['phone_mobile']);
    $salary_scale = mysqli_real_escape_string($db_connect, $_POST['salary_scale']);

    $division_name = mysqli_real_escape_string($db_connect, $_POST['division_name']);
    $appointment = mysqli_real_escape_string($db_connect, $_POST['appointment']);
    $service_category = mysqli_real_escape_string($db_connect, $_POST['service_category']);
    $employee_class = mysqli_real_escape_string($db_connect, $_POST['class']);
    $designation = mysqli_real_escape_string($db_connect, $_POST['designation']);
    $duties_assigned = mysqli_real_escape_string($db_connect, $_POST['duties_assigned']);
    $joined_public_date = mysqli_real_escape_string($db_connect, $_POST['joined_public_date']);
    $joined_nrmc = mysqli_real_escape_string($db_connect, $_POST['joined_nrmc']);
    $status = mysqli_real_escape_string($db_connect, $_POST['status']);
    $status_date = mysqli_real_escape_string($db_connect, $_POST['status_date']);
    $subject_to_desciplinary = mysqli_real_escape_string($db_connect, $_POST['subject_to_desciplinary']);

    // Check if employee already exists
    $emp_numb = mysqli_query($db_connect, "SELECT employee_number FROM employees WHERE employee_number = '$employee_number'");

    if ($emp_numb->num_rows === 1) {
        // Employee exist
        $sql = "UPDATE employees 
        SET name_with_initials = ?, 
            name_denoted_initials = ?, 
            date_of_birth = ?, 
            nic = ?, 
            permanent_address = ?, 
            postal_address = ?, 
            email = ?, 
            phone_office = ?, 
            phone_mobile = ?, 
            salary_scale = ?, 
            division_name = ?, 
            appointment = ?, 
            service_category = ?, 
            class = ?, 
            designation = ?, 
            duties_assigned = ?, 
            joined_public_date = ?, 
            joined_nrmc = ?, 
            status = ?, 
            status_date = ?, 
            subject_to_desciplinary = ? 
        WHERE employee_number = ?";

        
        $stmt = $db_connect->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssssssssss",
            $name_with_initials,
            $name_denoted_initials,
            $date_of_birth,
            $nic,
            $permanent_address,
            $postal_address,
            $email,
            $phone_office,
            $phone_mobile,
            $salary_scale,
            $division_name,
            $appointment,
            $service_category,
            $employee_class,
            $designation,
            $duties_assigned,
            $joined_public_date,
            $joined_nrmc,
            $status,
            $status_date,
            $subject_to_desciplinary,
            $employee_number
        );

        if ($stmt->execute()) {
            echo json_encode(array("response" => 100, "message" => "Employee added successfully."));
        } else {
            echo json_encode(array("response" => 500, "message" => $stmt->error));
        }

        $stmt->close();
    } else {
        // Employee does not exists
        echo json_encode(array("response" => 400, "message" => "Record not exists."));
    }

} else {
    echo json_encode(array("response" => 900, "message" => "Invalid request method."));
}
?>
