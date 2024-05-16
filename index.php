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


    <div class="container">
  <div class="row">
    <div id="login-container">
      <link rel="stylesheet" type="text/css" href="//s3.amazonaws.com/esp-static-contents/teledyne/teledyneProduction.css">
      <div class="logo-row logo-footer">
        <div class="link-center-align-container">
          <a class="link-style" href="/Account/TcloudAbout">About</a>
          <a class="link-style" href="/Account/TcloudSupport" style="margin-left: 40px;margin-right: 40px;">Support</a>
          <a class="link-style" href="/Account/TcloudUserAgreement">User Agreement</a>
        </div>
      </div>
      <div class="col-xs-12  col-sm-12  col-md-12 col-lg12" id="logo-row">
        <form action="/Account/Login?ReturnUrl=%2F" class="form-horizontal" method="post" role="form">
          <input name="__RequestVerificationToken" type="hidden" value="cqjMgIAQ3Hj6ViU2FSutj4MfvEDBmqUkDZPymUSCU6-3_WSuIkUjhlpMkx68lZxYcfHBGzT1GvHsrTpOdudr4rn7vroO3NqLwrVkjJ0yfvU1" />
          <div id="loginbox" class="panel panel-info" style="background-color: rgba(255,255,255,0.9);
border-radius: 10px; margin-left: auto;margin-right:auto; margin-top: 200px;">
            <div class="panel-title text-center">
              <span style="font-family: Freestyle Script;text-align: left;font-weight: 1000;font-size: 40px;color:#2f75b6">T</span>
              <span style="font-size:30px; font-weight:550; color :gray; font-family: Franklin Gothic Book; ">Cloud</span>
            </div>
            <div class="panel-title text-center" style="color:black">Teledyne Technologies</div>
            <div class="panel-info panel-body">
              <div class="col-xs-12 col-md-12">
                <div class="input-group ">
                  <span class="input-group-addon">
                    <i class="fa fa-at fa-fw"></i>
                  </span>
                  <input class="form-control" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="The Email field is required." id="Email" name="Email" placeholder="Email" style="height: 44px;margin-bottom: 2px;" type="text" value="" />
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-key fa-fw"></i>
                  </span>
                  <input class="form-control" data-val="true" data-val-required="The Password field is required." id="Password" name="Password" placeholder="Password" style="height: 44px;margin-bottom: 2px;" type="password" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12 col-md-12">
                  <span class="field-validation-valid text-danger validation-message" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                </div>
                <div class="col-xs-12 col-md-12">
                  <span class="field-validation-valid text-danger validation-message" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                </div>
                <div class="col-xs-12 col-md-12"></div>
              </div>
              <div style="">
                <input type="submit" value="Log in" class="btn btn-block" style="color: white; font-weight:400; background-color: #1f4e79;height:44px; margin-bottom: 5px;font-size: 20px" />
              </div>
              <div style="">
                <input type="button" value="Guest Login" class="btn btn-block" onclick="location.href='/Account/GuestLogin'" style="color: white; font-weight:400; background-color: #1f4e79;height:44px; margin-bottom: 20px;font-size: 20px" />
              </div>
              <div class="form-group">
                <div style="text-align: center;font-size: small;">
                  <a href="/Account/ForgotPassword">Forgot your password?</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



    

    <script>
	$("#loginForm").submit(function(event){
		
		event.preventDefault();

		var usernameerror;
		var passworderror;

		if($(".username").val() == ""){
			usernameerror = "Please enter your username";
		} else {
			usernameerror = "";
		}

		if($(".username").val() != "" && $(".username").val().length < 6){
			usernameerror = "Username must at least be 6 characters";
		}

		if($(".password").val() == ""){
			passworderror ="Please enter your password";
		} else {
			passworderror = "";
		}

		
		if($(".password").val() != "" && $(".password").val().length < 8){
			passworderror = "Password must at least be 6 characters";
		}


		$(".usernameerror").html(usernameerror);
		$(".passworderror").html(passworderror);

		if( usernameerror == "" && passworderror ==""){
			var response;

			$(".sign_in").html('<span class="sign-icon"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></span> Loading');

		$.ajax({
				type: 'post',
				url: 'index.php',
				dataType: 'json',
				data:{
					username: $(".username").val(),
					password: $(".password").val(),
					submit: 'submit'
				},
				success: function(data){
					response = (data.response);

					if(response == "Success"){
						$(".LogResponse").fadeIn();
						$(".LogResponse").html("Success");
						$(".LogResponse").css("background","#02fb8a");
						$(".LogResponse").css("color","#29820d");
						$(".sign_in").html('<span class="sign-icon"><i class="fa fa-lock"></i></span> Sign in');

						setTimeout(function() {
							window.location.replace("dashboard");;
						}, 3000);

					} else if(response == "password"){
						$(".LogResponse").fadeIn();
						$(".LogResponse").css("background","#900404");
						$(".LogResponse").css("color","#ff6666");
						$(".LogResponse").html("Invalid password");
						$(".sign_in").html('<span class="sign-icon"><i class="fa fa-lock"></i></span> Sign in');

						setTimeout(function(){
							$(".LogResponse").fadeOut();
						}, 3000)

					} else if(response == "username"){
						$(".LogResponse").fadeIn();
						$(".LogResponse").css("background","#900404");
						$(".LogResponse").css("color","#ff6666");
						$(".LogResponse").html("Invalid username");
						$(".sign_in").html('<span class="sign-icon"><i class="fa fa-lock"></i></span> Sign in')

						setTimeout(function(){
							$(".LogResponse").fadeOut();
						}, 3000)
					}
				}
			})
		}
	})
    </script>
 
<?php include("./inc/footer.php"); ?>