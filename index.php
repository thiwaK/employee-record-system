<?php 
    

    /*
     <?php
            if(isset($_GET['error'])){
                if($error_login == "failed_login"){?>

                    <div class="LogResponse2">Please Sign in first</div>

                <?php }
                }
            ?>
    
    
    */
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

 	<!-- <div class="login_wrapper clearfix">
 		
        <div class="logo_login">
            <img src="images/agri_logo.jpg">
            <h3> Employee Record System </h3>
            <br>
 		</div>
       
        <div class="LogResponse"></div>

 		<div class="login_wrapper_inner">
 			<form id="loginForm" class="clearfix" method="post" action="">
	 			<div class="input-box">
	 				<input type="text" class="inputField username" name="username" placeholder="username">
	 				<div class="error usernameerror"></div>
	 			</div>
	 			<div class="input-box">
	 				<input  type="password" class="inputField password" name="password" placeholder="password">
	 				<div class="error passworderror"></div>
	 			</div>

	 			<div class="input-box">
	 				<button  type="submit" class="submitField sign_in">
                        <span class="sign-icon"><i class="fa fa-lock"></i></span> Sign in</button>
	 			</div>
	 		</form>
 		</div>
 	</div>
 <div class="body_overlay"></div> -->




 <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Login</h2>
                <form id="loginForm" class="form" method="post" action="/ERS/dashboard/login.php" novalidate>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-lock mr-2"></i>Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Client-side form validation using Bootstrap's built-in styles
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
 
<?php include("./inc/footer.php"); ?>