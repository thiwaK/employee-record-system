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
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>NRMC Employee Record System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />   -->
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    	<link href="../css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </head>
	