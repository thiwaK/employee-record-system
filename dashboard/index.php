<?php
	include("../inc/header.php");
	include('../phpclasses/pagination.php');

	$limit = 10;         
		
	$allowedRoles = array("Admin", "Manager", "User");
	$activeEmployeeCount = 0;
	$divisionCount = 0;
	$userCount = 0;

	if(in_array($usertype, $allowedRoles)) {
		$getemp = mysqli_query($db_connect, "SELECT COUNT(*) as active_employee FROM employees WHERE `status`='Current Employee'");
		$resultNum = $getemp->fetch_assoc();
		$activeEmployeeCount = $resultNum['active_employee'];

		$getdiv = mysqli_query($db_connect, "SELECT COUNT(*) as divisions FROM divisions");
		$resultNum = $getdiv->fetch_assoc();
		$divisionCount = $resultNum['divisions'];

		$getuser = mysqli_query($db_connect, "SELECT COUNT(*) as user_cout FROM users");
		$resultNum = $getuser->fetch_assoc();
		$userCount = $resultNum['user_cout'];
	} else {
		header("Location: /ERS/dashboard/logout.php");
	}
?>

<div class="container-fluid">
	<div class="row ml-0 mr-0">
    
		<!-- Left sidebar for navigation -->
		<section class="col-lg-2 col-md-3 left border-right m-0" >
			<?php include("../inc/sidebar.php"); ?>
		</section>

		<!-- Main content area -->
		<section class="col-md-8 col-lg-9 right border-left m-0">
			<div class="row">
				<div class="col">
					<div class="card" style="height: 100px;">
						<div class="card-body">
							<div class="row d-flex">
								<div class="col-3">
									<span class="nav-link-icon" style="font-size: 40px;"><i class="fa fa-address-card"></i></span>
								</div>
								<div class="col-9">
									<h2 class="card-title">Active Employees</h2>
									<?php 
									echo '<p class="card-text font-weight-bold"><span id="activeEmployeesCount">' . $activeEmployeeCount . '</span></p>';
									?>
								</div>
							</div>	
						</div>
					</div>
				</div>
				
				<div class="col">
					<div class="card">
						<div class="card-body">

							<div class="row">
								<div class="col-3">
									<span class="nav-link-icon" style="font-size: 40px;"><i class="fa fa-building"></i></span>
								</div>
								<div class="col-9">
									<h2 class="card-title">Divisions</h2>
									<?php 
									echo '<p class="card-text font-weight-bold"><span id="divisionsCount">' . $divisionCount . '</span></p>';
									?>
								</div>
							</div>	
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<span class="nav-link-icon" style="font-size: 40px;"><i class="fa fa-users"></i></span>
								</div>
								<div class="col-9">
									<h2 class="card-title">Users</h2>
									<?php 
									echo '<p class="card-text font-weight-bold"><span id="usersCount">' . $userCount . '</span></p>';
									?>
								</div>
							</div>	
						</div>
					</div>
				</div>

			</div>
		</section>
	</div>

<?php
	include("../inc/footer.php");
?>