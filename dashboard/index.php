<?php
	include("../inc/header.php");
    include('../phpclasses/pagination.php');

    $limit = 10;
	    
	//get number of rows
	if($usertype == "Admin"){
		$queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee LIMIT $limit");
		$resultNum = $queryNum->fetch_assoc();
		$rowCount = $resultNum['postNum'];
												
		//initialize pagination class
		$pagConfig = array(
			'totalRows' => $rowCount,
			'perPage' => $limit,
			'link_func' => 'searchFilter'
		);
		$pagination =  new Pagination($pagConfig);


	} else if($usertype=="superuser") {
		$query = $db_connect->query("SELECT userunit  FROM users WHERE username='$username'");
		$result = $query->fetch_assoc();
		$unitname = $result['userunit'];
		//	echo $unitname;
		$queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee 
		INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
		INNER JOIN users ON units_of_etc.unit_name=users.userunit
		WHERE employee.unit='$unitname'");
		$resultNum = $queryNum->fetch_assoc();
		$rowCount = $resultNum['postNum'];
										    
		//initialize pagination class
		$pagConfig = array(
			'totalRows' => $rowCount,
			'perPage' => $limit,
			'link_func' => 'searchFilter'
		);
		$pagination =  new Pagination($pagConfig);
	}


?>

<div class="container-fluid">
  <div class="row ml-0 mr-0">
    
	<!-- Left sidebar for navigation -->
    <section class="col-lg-2 col-md-3 left border-right m-0" >
      <div class="sidebar">

		<div class="card bg-transparent text-center border-0">
			<img class="card-img-top mx-auto mt-3" style="max-width: 50%;" src="../images/logo.png" alt="NRMC Logo">
			<div class="card-body">
				<h5 class="card-title">Employee Record System</h5>
				<p class="card-text">Logged in as <?php echo $username; ?></p>
			</div>
		</div>

        <ul class="nav flex-column pt-2 pl-3">
            <!-- Employees  -->
            <li class="nav-item">
                <a class="nav-link nav-icon" href="#employeesSubMenu" data-toggle="collapse" aria-expanded="false" aria-controls="employeesSubMenu">
					<i class="fa fa-minus"></i> Employees</a>
                <ul class="nav flex-column collapse" id="employeesSubMenu" style="margin-top: 0;">
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/current_employees.php"><span class="nav-icon"><i class="fa fa-check"></i></span>Current Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/past_employees.php"><span class="nav-icon"><i class="fa fa-times"></i></span>Past Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/report_print.php"><span class="nav-icon"><i class="fa fa-print"></i></span>Employee reports</a></li>
                    <?php if($usertype == "Admin" || $usertype == "superuser") {?>
                        <li class="nav-item submenu"><a class="nav-link" href="../dashboard/add_employee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
                    <?php }?>
                </ul>
            </li>

            <!-- Divisions -->
            <li class="nav-item">
                <a class="nav-link nav-icon" href="#divisionsSubMenu" data-toggle="collapse" aria-expanded="false" aria-controls="divisionsSubMenu">
					<i class="fa fa-minus"></i> Division</a>
                <ul class="nav flex-column collapse" id="divisionsSubMenu" style="margin-top: 0;">
                    <!-- TODO Add Divisions Here -->
                </ul>
            </li>

            <!-- Preferences -->
            <li class="nav-item">
                <a class="nav-link nav-icon" href="#preferencesSubMenu" data-toggle="collapse" aria-expanded="false" aria-controls="preferencesSubMenu">
					<i class="fa fa-minus"></i> Preferences</a>
                <ul class="nav flex-column collapse" id="preferencesSubMenu" style="margin-top: 0;">
                    <!-- TODO Add Preferences Here -->
                    <li class="nav-item submenu"><a class="nav-link" href="../backup/sys_backup.php"><span class="nav-icon"><i class="fa fa-database" aria-hidden="true"></i></span>Back up database</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/add_user.php"><span class="nav-icon"><i class="fa fa-user"></i></span>Add User</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
                </ul>
            </li>

			<!-- Logout -->
            <li class="nav-item">
				<a class="nav-link" href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out-alt"></i></span>Sign out</a>
			</li>
        </ul>
      </div>
    </section>

    <!-- Main content area -->
    <section class="col-md-8 col-lg-9 right border-left m-0">
		<div class="">
			<div class="h2 d-flex">All Employees</div>

				<div class="m-2 align-items-center">
					<div class="d-inline-block">
						<form id="empFilter" method="post" action="" class="form-inline">
							<div class="form-group">
								<input class="form-control" type="text" placeholder="Search by Name, Designation, Division" style="width: 350px;" onkeyup="searchFilter()">
							</div>
						</form>
					</div>
					
					<div class="d-inline-block">
					<form id="empFilter" method="post" action="" class="form-inline">
						<div class="form-group">
							<select class="form-control sortField sortVal" onchange="searchFilter()">
							<option value="ASC">Newest</option>
							<option value="DESC">Oldest</option>
							</select>
						</div>
						</form>
					</div>

				</div>

				<?php
					if($usertype=="Admin") {
						$getemp = mysqli_query($db_connect, "SELECT * FROM employee ORDER BY employee_id DESC LIMIT $limit");
						$getempcount = mysqli_num_rows($getemp);

					} else if($usertype=="superuser") {
						$getemp = mysqli_query($db_connect, "SELECT * FROM employee 
							INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
							INNER JOIN users ON units_of_etc.unit_name=users.userunit
								WHERE employee.unit='$unitname'
							ORDER BY employee_id DESC LIMIT $limit");
						$getempcount = mysqli_num_rows($getemp);	
					}
				?>

				<table class="table table-hover table-sm">
					<thead class="thead-dark">
						<th class="emp_id">Employee ID</th>
						<th class="">Name</th>
						<th class="">Designation</th>
						<th class="">Unit</th>
						<th class="">Service Category</th>
						<!-- <th class="">Action</th> -->
						</tr>
					</thead>
					<tbody id="displayempList" class="">
						<?php
						if($getempcount >= 1 ) {
							while($fetch = mysqli_fetch_assoc($getemp)) {
								$id = $fetch['id'];
								$emp_id = $fetch['employee_id'];
								$name_with_initials = $fetch['name_with_initials'];
								$designation = $fetch['designation'];
								$unit = $fetch['unit'];
								$service_category = $fetch['service_category'];

								echo '<tr class="">';
									echo '<td class="emp_id">' . $emp_id . '</td>';
									echo '<td class="">' . $name_with_initials . '</td>';
									echo '<td class="">' . $designation . '</td>';
									echo '<td class="">' . $unit . '</td>';
									echo '<td class="">' . $service_category . '</td>';
								echo '</tr>';
							}
							echo $pagination->createLinks();
						} else {
							echo '<tr class="emp_item"><td colspan="6"> No employee record found </td></tr>';
						}
						?>
					</tbody>
				</table>
		</div>
	</section>


	<!-- Add print page option -->

<script>
    // $(document).ready(function(){
    //     $('.nav-link').click(function(){

    //         // Toggle indicators
	// 		// $('.nav-link').not(this).removeClass('collapsed');
    //         // $('.nav-link').not(this).attr('aria-expanded', 'false');
    //         // $('.nav-link').not(this).parent().find('.collapse').removeClass('show');

	// 		$('.fa').not(this).removeClass('collapsed').removeClass('fa-plus').addClass('fa-minus');
            
	// 		if ($(this).attr('aria-expanded') === 'true') {
	// 			$(this).find('.fa').removeClass('fa-plus').addClass('fa-minus');
    //         } else {
    //             $(this).find('.fa').removeClass('fa-minus').addClass('fa-plus');
    //         }
    //     });
    // });
</script>



<?php
	include("../inc/footer.php");
?>