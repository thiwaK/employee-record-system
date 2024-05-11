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

<section class="col-md-4 col-lg-3 d-md-block sidebar" style="height: 100vh; overflow-y: auto;">
    <div class="sidebar-sticky">
        <div class="top-sec m-3">
            <div class="dash_logo"><img src="../images/logo.png" alt="Dashboard Logo"></div>
            <h4 class="mt-5">Employee Record System</h4>
            <p class="m-4">Logged in as <?php echo $username; ?></p>
        </div>

        <ul class="nav flex-column mt-1">
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
            <li class="nav-item"><a class="nav-link" href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out-alt"></i></span>Sign out</a></li>
        </ul>
    </div>
</section>

<section class="col-md-8 col-lg-9 right clearfix" style="height: 100vh; overflow-y: auto;">
	
	<div class="container">
		<div class="wrapper employee_list clearfix">
			
		<div class="section_title d-flex">All Employees</div>


			<div class="top-bar align-items-center">
				
				<div class="top-item">
					<form id="empFilter" method="post" action="">
						<!-- <?php if($usertype=="Admin"){?>
							<input class="filterField filterVal" type="text" placeholder="Search by Name,Designation,Unit" onkeyup="searchFilter()">
						<?php }?> -->
						<!-- <?php if($usertype=="superuser"){?>
							<input class="filterField filterVal" type="text" placeholder="Search by Name,Designation" onkeyup="searchFilter()">
						<?php }?> -->
						<input class="filterField filterVal" type="text" placeholder="Search by Name, Designation, Division" onkeyup="searchFilter()">
					</form>
				</div>
				
				<div class="top-item">
					<form id="empFilter" method="post" action="">
						<select class="sortField sortVal" onchange="searchFilter()">
							<option value="ASC">Newest</option>
							<option value="DESC">Oldest</option>
						</select>
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

			<ul class="emp_list">

				<li class="emp_list_head">
					<div class="emp_item_head emp_id">Employee ID</div>
					<div class="emp_item_head ">Name</div>
					<div class="emp_item_head">Designation</div>
					<div class="emp_item_head">Unit</div>
					
					<div class="emp_item_head ">Service Category</div>
					<div class="emp_item_head">Action</div>
				</li>
				
				<div id="displayempList">
					<?php
						if($getempcount >= 1 ){
							while($fetch = mysqli_fetch_assoc($getemp)){
								$id = $fetch['id'];
								$emp_id = $fetch['employee_id'];
								$name_with_initials = $fetch['name_with_initials'];
								$designation = $fetch['designation'];
								$unit = $fetch['unit'];
								$service_category = $fetch['service_category'];

								if($usertype == "Admin" or $usertype == "superuser" ){
									echo '										
										<li class="emp_item">
											<div class="emp_column emp_id">'.$emp_id.'</div>
											<div class="emp_column ">'.$name_with_initials.'</div>
											<div class="emp_column">'.$designation.'</div>
											<div class="emp_column">'.$unit.'</div>
											<div class="emp_column ">'.$service_category.'</div>

											<div class="emp_column">
												<ul class="action_list">
													<li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
													<li class="action_item action_edit" data-id="'.$id.'" title="Edit"><i class="fa fa-pencil-square-o"></i></li>
													<li class="action_item action_delete" data-id="'.$id.'" title="Delete"><i class="fa fa-trash-o"></i></li>
												</ul>
											</div>
										</li>
									';
								} else {

									echo '										
										<li class="emp_item">
											<div class="emp_column emp_id">'.$emp_id.'</div>
											<div class="emp_column ">'.$name_with_initials.'</div>
											<div class="emp_column">'.$designation.'</div>
											<div class="emp_column">'.$unit.'</div>
											<div class="emp_column ">'.$service_category.'</div>

											<div class="emp_column">
												<ul class="action_list">
													<li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
												</ul>
											</div>
										</li>
									';
								}
								
							}
							
							echo $pagination->createLinks();
						
						} else {
							echo '<li class="emp_item"> No employee record found </li>';
						}
					?>
				</div>

			</ul>
		</div>

	</div>


	<div class="modal">
		<span class="close-modal">
			<img src="../images/times.png">
		</span>
		<div class="inner_section">
			<div id="record_container" class="record_container">
				<span class="print-modal" onclick="Clickheretoprint()">
					<img src="../images/print.png">
				</span>
				<div id="table">
				</div>
				<div class="printbtn_wrapper">
					<span class="printbtn"> Print</span>
				</div>
			</div>
		</div>
	</div>


	<div class="del_modal">
		<div class"inner_section">
			<div class="delcontainer">
				<div class="del_title">Delete Record</div>
				<div class="del_warning"></div>
				<div class="btnwrapper">
					<span class="delbtn yesbtn" data-id="">Yes</span>
					<span class="delbtn nobtn">No</span>
				</div>
			</div>
		</div>
	</div>

</section>


<script>
    $(document).ready(function(){
        $('.nav-link').click(function(){

            // Toggle indicators
			// $('.nav-link').not(this).removeClass('collapsed');
            // $('.nav-link').not(this).attr('aria-expanded', 'false');
            // $('.nav-link').not(this).parent().find('.collapse').removeClass('show');

			$('.fa').not(this).removeClass('collapsed').removeClass('fa-plus').addClass('fa-minus');
            
			if ($(this).attr('aria-expanded') === 'true') {
				$(this).find('.fa').removeClass('fa-plus').addClass('fa-minus');
            } else {
                $(this).find('.fa').removeClass('fa-minus').addClass('fa-plus');
            }
        });
    });
</script>



<?php
	include("../inc/footer.php");
?>