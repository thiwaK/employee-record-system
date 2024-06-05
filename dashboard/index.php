<?php
	include("../include/header.php");
	include("../include/db_connect.php");
	include("../include/validate_login.php");

	$limit = 10;         
	$activeEmployeeCount = 0;
	$retiredEmployeeCount = 0;
	$transferredEmployeeCount = 0;
	$divisionCount = 0;
	$userCount = 0;

	if(in_array($usertype, $allowedRoles)) {
		$getemp = mysqli_query($db_connect, "SELECT COUNT(*) as e_count FROM employees WHERE `status`='Current Employee'");
		$resultNum = $getemp->fetch_assoc();
		$activeEmployeeCount = $resultNum['e_count'];

		$getemp = mysqli_query($db_connect, "SELECT COUNT(*) as e_count FROM employees WHERE `status`='Retired Employee'");
		$resultNum = $getemp->fetch_assoc();
		$retiredEmployeeCount = $resultNum['e_count'];

		$getemp = mysqli_query($db_connect, "SELECT COUNT(*) as e_count FROM employees WHERE `status`='Transferred Employee'");
		$resultNum = $getemp->fetch_assoc();
		$transferredEmployeeCount = $resultNum['e_count'];

		$getemp = mysqli_query($db_connect, "SELECT COUNT(*) as e_count FROM employees WHERE `status`='Retired Employee' OR `status`='Transferred Employee'");
		$resultNum = $getemp->fetch_assoc();
		$otherEmployeeCount = $resultNum['e_count'];
		

		$getdiv = mysqli_query($db_connect, "SELECT COUNT(*) as divisions FROM divisions");
		$resultNum = $getdiv->fetch_assoc();
		$divisionCount = $resultNum['divisions'];

		$getuser = mysqli_query($db_connect, "SELECT COUNT(*) as user_cout FROM users WHERE `accounttype`='Admin'");
		$resultNum = $getuser->fetch_assoc();
		$AdminUserCount = $resultNum['user_cout'];

		$getuser = mysqli_query($db_connect, "SELECT COUNT(*) as user_cout FROM users WHERE `accounttype`='User'");
		$resultNum = $getuser->fetch_assoc();
		$generalUserCount = $resultNum['user_cout'];


		$query = "
			SELECT 
				division_name, 
				COUNT(employee_number) AS employee_count,
				GROUP_CONCAT(CASE WHEN designation = 'Division Head'  THEN name_with_initials END SEPARATOR ', ') AS division_head
			FROM employees
			WHERE status = 'Current Employee'
			GROUP BY division_name
		";
		$result1 = $db_connect->query($query);
		$divisions = [];
		if ($result1->num_rows > 0) {
			while ($row = $result1->fetch_assoc()) {
				$divisions[$row['division_name']] = [
					'employee_count' => $row['employee_count'],
					'division_head' => $row['division_head'],
					'designated_employees' => []
				];
			}
		}

		$query = "
			SELECT 
				division_name, 
				designation, 
				COUNT(*) AS designation_count
			FROM employees
			WHERE status = 'Current Employee'
			GROUP BY division_name, designation
			ORDER BY division_name, designation
		";
		$result2 = $db_connect->query($query);
		if ($result2->num_rows > 0) {
			while ($row = $result2->fetch_assoc()) {
				$division_name = $row['division_name'];
				$designation = $row['designation'] . ' ' . $row['designation_count'];
				if (isset($divisions[$division_name])) {
					$divisions[$division_name]['designated_employees'][] = $designation;
				}
			}
		}


	} else {
		// header("Location: /ERS/api/logout.php");
	}
?>

<div class="container-fluid">
	<div class="row ml-0 mr-0">
    
		<!-- Left sidebar for navigation -->
		<section class="col-lg-2 col-md-3 left border-right m-0" >
			<?php include("../include/sidebar.php"); ?>
		</section>

		<!-- Main content area -->
		<section class="col-md-8 col-lg-9 right border-left m-0">
			<div class="row">
				<div class="col">
					<div class="card" style="height: 100px;">
						<div class="card-body">
						<a href="../dashboard/employees.php?q=all" class="card-body-link">
							<div class="row d-flex">
								<div class="col-3">
									<span class="nav-link-icon" style="font-size: 40px;"><i class="fa fa-address-card"></i></span>
								</div>
								<div class="col-9">
								<h2 class="card-title">Employees</h2>
									<div class="row">
										<div class="col-5">
											<?php 
												echo '<div class="card-text badge badge-primary" style="background-color:var(--icon)">Active <div class="card-text badge badge-dark">' . $activeEmployeeCount . '</div></span></div>';
											?>
										</div>
										<div class="col-5">
											<?php 
												echo '<div class="card-text badge badge-primary" style="background-color:var(--icon)">Other <div class="card-text badge badge-dark">' . $otherEmployeeCount . '</div></span></div>';
											?>
										</div>
		
									</div>							
								</div>
							</div>
							</a>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card">
						<div class="card-body">
							<a href="../dashboard/divisions.php?q=A" class="card-body-link">
							<div class="row">
								<div class="col-3">
									<span class="nav-link-icon" style="font-size: 40px;"><i class="fa fa-building"></i></span>
								</div>
								<div class="col-9">
									<h2 class="card-title">Divisions</h2>
									<?php 
										echo '<div class="card-text badge badge-primary" style="background-color:var(--icon)">Total <div class="card-text badge badge-dark">' . $divisionCount . '</div></span></div>';
									?>
									<?php 
									#echo '<p class="card-text font-weight-bold"><span id="divisionsCount">' . $divisionCount . '</span></p>';
									?>
								</div>
							</div>
							</a>	
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card">
						<div class="card-body">
							<a href="../dashboard/users.php?q=all_users" class="card-body-link">
							<div class="row">
								<div class="col-3">
									<span class="nav-link-icon" style="font-size: 40px;"><i class="fa fa-users"></i></span>
								</div>
								<div class="col-9">
									<h2 class="card-title">Users</h2>
									<?php 
									#echo '<p class="card-text font-weight-bold"><span id="usersCount">' . $userCount . '</span></p>';
									?>
									<div class="row">
										<div class="col-5">
											<?php 
												echo '<div class="card-text badge badge-primary" style="background-color:var(--icon)">Admins <div class="card-text badge badge-dark">' . $AdminUserCount . '</div></span></div>';
											?>
										</div>
										<div class="col-5">
											<?php 
												echo '<div class="card-text badge badge-primary" style="background-color:var(--icon)">Other <div class="card-text badge badge-dark">' . $generalUserCount . '</div></span></div>';
											?>
										</div>
		
									</div>
								</div>
							</div>
							</a>	
						</div>
					</div>
				</div>
			</div>

			<!-- Table for division statistics -->
			<div class="row mt-4">
				<div class="col-12">
					<div class="card" >
						<div class="card-body">
							<!-- <h2 class="card-title">Division Statistics</h2> -->
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Division</th>
										<th>Number of Employees</th>
										<th>Heads</th>
										<th>Designations</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($divisions as $division_name => $division) {
											echo '<tr>';
											echo '<td>' . $division_name . '</td>';
											echo '<td>' . $division['employee_count'] . '</td>';
											echo '<td>' . $division['division_head'] . '</td>';
											echo '<td>';
											foreach ($division['designated_employees'] as $designation) {
												echo '<span class="badge badge-primary">' . $designation . '</span> ';
											}
											echo '</td>';
											echo '</tr>';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			


		</section>
	</div>

<?php
	include("../include/footer.php");
?>