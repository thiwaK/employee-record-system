<?php
	include("../inc/header.php");

    include('../phpclasses/pagination.php');

	if($usertype != "Admin"){
        header("Location: ../dashboard");
    }

?>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>NRMC Employee Record</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    	<link href="../css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.js"></script>
		<script type="text/javascript" src="../js/global.js"></script>
    </head>
<body>
	<section class="side-menu fixed left">
		<div class="top-sec">
			<div class="dash_logo">
				<img src="../images/logo.png">
			</div>	<br> <br>		
			<p>Employee Record System</p><br>
			<p style="font-size:12px">Logged as <?php echo $username ?></p>
			</div>
		<ul class="nav">
			<li class="nav-item"><a href="../dashboard"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
			<li class="nav-item"><a href="../dashboard/current_employees.php"><span class="nav-icon"><i class="fa fa-check"></i></span>Current Employees</a></li>
			<li class="nav-item"><a href="../dashboard/past_employees.php"><span class="nav-icon"><i class="fa fa-times"></i></span>Past Employees</a></li>
			<li class="nav-item"><a href="../dashboard/report_print.php"><span class="nav-icon"><i class="fa fa-print"></i></span>Employee reports</a></li>
			<li class="nav-item"><a href="../dashboard/add_employee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
			<?php if($usertype == "Admin"){ ?>
				<li class="nav-item"><a href="../backup/sys_backup.php"><span class="nav-icon"><i class="fa fa-database" aria-hidden="true"></i></span>Back up database</a></li>
				<li class="nav-item current"><a href="../dashboard/add_user.php"><span class="nav-icon"><i class="fa fa-user"></i></span>Add User</a></li>
				
			<?php		} ?>
			<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
			<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
	</section>
	<section class="contentSection right clearfix">
		<div class="displaySuccess"></div>
		<div class="container">
			<div class="wrapper add_employee clearfix">
				<div class="section_title">Add User</div>
				<form id="adduser" class="clearfix" method="post" action="
				">
					<div class="input-box input-small left">
						<label for="idtype">Account type</label><br>
						<select class="inputField usertype" name="idtype">
							<option value="">-- Select user role --</option>
							<option value="Admin">Admin</option>
							<option value="superuser">Superuser</option>
							<option value="Employee">Employee</option>
						</select>
						<div class="error usertypeerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="userunit">Unit of user</label><br>
						<select class="inputField userunit" name="userunit">
							<option value="">-- Select user unit --</option>
							<?php

								require_once("conn.php");
								$dbobj = new dbConnection();
								$con = $dbobj->getCon();
	
								$sql = "SELECT DISTINCT unit_name FROM divisions_of_nrmc WHERE 1;";
								$result = mysqli_query($con,$sql);
								$nor = $result->num_rows;
	
								if($nor>0){
								while($rec = mysqli_fetch_assoc($result)){
										$unit_name = $rec["unit_name"];
										echo("<option value='".$rec["unit_name"]."'>".$unit_name."</option>");
													}
												}	
									mysqli_close($con);?>
						</select>
						<div class="error useruniterror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="firstname">First Name</label><br>
						<input type="text" class="inputField firstname" name="firstname">
						<div class="error firstnameerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="lastname">Last Name</label><br>
						<input type="text" class="inputField lastname" name="lastname">
						<div class="error lastnameerror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="username">Username</label><br>
						<input type="text" class="inputField username" name="username">
						<div class="error usernameerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="password">Password</label><br>
						<input type="password" class="inputField password" name="password">
						<div class="error passworderror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="confirmpassword">Confirm Password</label><br>
						<input type="password" class="inputField confirmpassword" name="confirmpassword">
						<div class="error confirmpassworderror"></div>
					</div>
					<div class="input-box">
						<button type="submit" class="submitField">ADD USER</button>
					</div>
				</form>
			</div>
		</div>
	</section>

</body>
</html>