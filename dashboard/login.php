<?php 

include("../inc/db_connect.php");

session_start();

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    
    echo json_encode(array("response" => isset($_POST['username'])));

    if(isset($_POST['username']) && isset($_POST['password'])) {

        $realusername = mysqli_real_escape_string($db_connect, $_POST['username']);
        $password = $_POST['password'];

        // Check if username exists in the database
        $check_details = mysqli_query($db_connect, "SELECT user_id, username, password FROM users WHERE username = '$realusername'");
        $check_details_row = mysqli_fetch_assoc($check_details);

        if($check_details_row) {
            // Verify the password
            if(password_verify($password, $check_details_row['password'])) {
                // Password is correct, set session and redirect
                $_SESSION["username"] = $realusername;
                echo json_encode(array("response" => "Login successful"));
                exit();
            } else {
                // Password is incorrect
                echo json_encode(array("response" => "Invalid password"));
                exit();
            }
        } else {
            // Username does not exist
            echo json_encode(array("response" => "Invalid username"));
            exit();
        }
    } else {
        // Form fields are not set
        echo json_encode(array("response" => "Form fields not set"));
        exit();
    }
} else {
    // Redirect if accessed via GET request
    echo json_encode(array("response" => "Something Wrong"));
    exit();
}
?>
