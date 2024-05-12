<?php
    include("db_connect.php");

    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = '';
    }

    if(!$username) {
        header("Location: ../index.php?error=failed_login");
    }

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NRMC Employee Record System</title>
    <meta name="description" content="Employee Record System - NRMC">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/ERS/css/bootstrap.min.css">
	<link href="/ERS/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/ERS/css/style.css"/>

    <script src="/ERS/js/jquery.slim.min.js"></script>
    <script src="/ERS/js/bootstrap.bundle.min.js"></script>

</head>
<body>	
