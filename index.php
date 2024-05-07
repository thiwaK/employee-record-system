<?php 
    ob_start();
    include("./inc/db_connect.php");

    session_start();
    if (isset($_SESSION['username'])){

        $username = $_SESSION['username'];

    }
    else {
        
        $username = '';
    }

    if($username){
        header("location: dashboard");
    }


    if(isset($_GET['error'])){
        $error_login = "failed_login";
    }


    if(isset($_POST['submit'])){

        $realusername = mysqli_real_escape_string($db_connect, $_POST['username']);
        $password = mysqli_real_escape_string($db_connect, $_POST['password']);
        
        $check_details = mysqli_query($db_connect, "SELECT username FROM users WHERE username = '$realusername' ");
        $check_details_row = mysqli_num_rows($check_details);

        if($check_details_row == 1){

            while($row = mysqli_fetch_array($check_details)){
                $usernamenew = $row['username'];
            }

            $loginpassword = md5(md5($password).md5($usernamenew));

            $sql = mysqli_query($db_connect, "SELECT user_id FROM users WHERE username = '$usernamenew' AND password = '$loginpassword' LIMIT 1 ");
            $sqlcount = mysqli_num_rows($sql);
            ob_end_clean();
            if ($sqlcount == 1){
                echo json_encode(array("response"=>"Success"));
                $_SESSION["username"] = $realusername;
                exit();

            } else {
                echo json_encode(array("response"=>"password"));
                exit();
            }
        } else {
            echo json_encode(array("response"=>"username"));
            exit();
        }
    

    }


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Employee Record System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <link rel="shortcut icon" href="/chromeextentionsaremakingmemad.ico" />
    </head>
 <body id="loginPage">
 	<div class="login_wrapper clearfix">
 		<div class="logo_login">
            <img src="images/agri_logo.jpg">
             <h3> Employee Record System </h3>
<br>
 		</div>
        <?php
            if(isset($_GET['error'])){
                if($error_login == "failed_login"){?>

                    <div class="LogResponse2">Please Sign in first</div>

                <?php }
                }
            ?>
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
	 				<button  type="submit" class="submitField sign_in"><span class="sign-icon"><i class="fa fa-lock"></i></span> Sign in</button>
	 			</div>
	 		</form>
 		</div>
 	</div>
 <div class="body_overlay"></div>
 
  <script type="text/javascript" src="./js/global.js"></script>
 </body>
 </html>