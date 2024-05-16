<?php
    include("db_connect.php");

    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = null;
    }

    
    //-------------------------------FOR Debugging ONLY!!!

    // if(!$username) {
    //     header("Location: /ERS/index.php?error=failed_login");
    // }

    // --------------------------------

    $usertype;
    $userdetails = mysqli_query($db_connect, "SELECT * FROM users WHERE username='$username' ");
    $userdetailscount = mysqli_num_rows($userdetails);

    if($userdetailscount == 1){
        while($fetch = mysqli_fetch_assoc($userdetails)){
            $id = $fetch['user_id'];
            $firstname = $fetch['firstname'];
            $lastname = $fetch['lastname'];
            $username = $fetch['username'];
            $usertype = $fetch['accounttype'];
        }
    }

    //-------------------------------FOR Debugging ONLY!!!
    $firstname = 'Thiwanka';
    $lastname = 'Kaushal';
    $username = 'TK';
    $usertype = 'Admin';
    // --------------------------------
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NRMC Employee Record System</title>
    <meta name="description" content="Employee Record System - NRMC">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/ERS/css/bootstrap.min.css">
	<link href="/ERS/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    
    <link href="/ERS/css/theme.css" rel="stylesheet" id="style-default">
    <link rel="stylesheet" type="text/css" href="/ERS/css/style.css"/>

    <script src="/ERS/js/jquery.slim.min.js"></script>
    <script src="/ERS/js/bootstrap.bundle.min.js"></script>

</head>
<body>	
