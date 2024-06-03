<?php
    include("db_connect.php");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $allowedRoles = array("Admin", "User");
    $adminOnly = array("Admin",);

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = null;
    }

    if(!$username) {
        header("Location: /ERS/index.php?reason=invalid_user&v=$username");
    }


    $usertype;
    $userdetails = mysqli_query($db_connect, "SELECT * FROM users WHERE username='$username' ");
    $userdetailscount = mysqli_num_rows($userdetails);

    if($userdetailscount == 1){
        while($fetch = mysqli_fetch_assoc($userdetails)){
            $id = $fetch['user_id'];
            // $firstname = $fetch['firstname'];
            // $lastname = $fetch['lastname'];
            $username = $fetch['username'];
            $usertype = $fetch['accounttype'];
        }
    }

    //-------------------------------For Debugging ONLY!!!
    // $firstname = 'Thiwanka';
    // $lastname = 'Kaushal';
    // $username = 'TK';
    // $usertype = 'Admin';
    // --------------------------------

?>