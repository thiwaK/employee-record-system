<?php 

include("../include/db_connect.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['username']) && !isset($_POST['password'])) {
        // Missing fields
        echo json_encode(array("response" => 800));
        exit();
    }   

    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check if username exists in the database
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $db_connect->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // echo base64_encode(password_hash("WhoCares", PASSWORD_DEFAULT));

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(password_verify($pass, base64_decode($row['password']))) {
            $_SESSION["username"] = $user;
            echo json_encode(array("response" => 100));
            
            // header("Location: index.php");
        } else {
            // Password is incorrect
            echo json_encode(array("response" => "Invalid credentials"));
        }
    } else {
        // Username does not exist
        echo json_encode(array("response" => "Invalid credentials"));
    }
   
} else {
    // Invalid Method
    echo json_encode(array("response" => "Something wrong"));
}
?>
