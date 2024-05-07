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
		}								    
	//get rows
	else if($usertype=="superuser")	
	{
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
	<section class="side-menu fixed left">
		<div class="top-sec">
			<div class="dash_logo">
				<img src="../images/logo.png">
		</div><br> <br>			
			<p>Employee Record System</p><br>
			<p style="font-size:12px">Logged as <?php echo $username ?></p>
		</div>
		<ul class="nav">
			<li class="nav-item current"><a href="../dashboard"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
			<li class="nav-item"><a href="../dashboard/current_employees.php"><span class="nav-icon"><i class="fa fa-check"></i></span>Current Employees</a></li>
			<li class="nav-item"><a href="../dashboard/past_employees.php"><span class="nav-icon"><i class="fa fa-times"></i></span>Past Employees</a></li>
			<li class="nav-item"><a href="../dashboard/report_print.php"><span class="nav-icon"><i class="fa fa-print"></i></span>Employee reports</a></li>
			<?php if($usertype == "Admin" || $usertype =="superuser"){ ?>
				<li class="nav-item"><a href="../dashboard/add_employee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
			<?php 	} ?>
			<?php	if($usertype == "Admin"){?>
					<li class="nav-item"><a href="../backup/sys_backup.php"><span class="nav-icon"><i class="fa fa-database" aria-hidden="true"></i></span>Back up database</a></li>
					<li class="nav-item"><a href="../dashboard/add_user.php"><span class="nav-icon"><i class="fa fa-user"></i></span>Add User</a></li>
			<?php 	} ?>
			<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
			<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-
			-out"></i></span>Sign out</a></li>
		</ul>
	</section>
	<section class="contentSection right clearfix">
		<div class="container">
			<div class="wrapper employee_list clearfix">
				<div class="section_title">All Employees</div>
				<div class="top-bar">
					<div class="top-item">
						<form id="empFilter" method="post" action="">
							<?php if($usertype=="Admin"){?>
							<input class="filterField filterVal" type="text" placeholder="Search by Name,Designation,Unit" onkeyup="searchFilter()">
						<?php }?>
						<?php if($usertype=="superuser"){?>
							<input class="filterField filterVal" type="text" placeholder="Search by Name,Designation" onkeyup="searchFilter()">
						<?php }?>
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
					if($usertype=="Admin")
					{
					$getemp = mysqli_query($db_connect, "SELECT * FROM employee ORDER BY employee_id DESC LIMIT $limit");
					$getempcount = mysqli_num_rows($getemp);
				   }
				    else if($usertype=="superuser")	
					{
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
<script type="text/javascript" src="../js/global.js"></script>
</body>
</html>