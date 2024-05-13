<?php
	include("../inc/header.php");
    include('../phpclasses/pagination.php');

    $limit = 10;
	$allowedRoles = array("Admin", "Manager", "User");
	    

	if(in_array($usertype, $allowedRoles)){
		$queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee WHERE status='Current Employee' LIMIT $limit");
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

<?php
	if($usertype=="Admin")
	{
	$getemp = mysqli_query($db_connect, "SELECT * FROM employee WHERE status='Current Employee' ORDER BY employee_id ASC LIMIT $limit");
	$getempcount = mysqli_num_rows($getemp);
	}
	else if($usertype=="superuser")	
	{
	$getemp = mysqli_query($db_connect, "SELECT * FROM employee 
		INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
		INNER JOIN users ON units_of_etc.unit_name=users.userunit
			WHERE employee.unit='$unitname' AND status='Current Employee' 
		ORDER BY employee_id ASC LIMIT $limit");
	$getempcount = mysqli_num_rows($getemp);

	}

	?>

<div class="container-fluid">
	<div class="row ml-0 mr-0">
		<!-- Left sidebar for navigation -->
		<section class="col-lg-2 col-md-3 left border-right m-0" >
			<?php include("../inc/sidebar.php"); ?>
		</section>

		<section class="contentSection right clearfix">
			
			<div class="container">
				<div class="wrapper employee_list clearfix">
					<div class="section_title">All Current Employees</div>
					<div class="top-bar">
						<div class="top-item">
							<form id="empFilter" method="post" action="">
								<?php if($usertype=="Admin"){?>
								<input class="filterField filterVal" type="text" placeholder="Search by Name,Designation,Unit" onkeyup="currsearchFilter()">
							<?php }?>
							<?php if($usertype=="superuser"){?>
								<input class="filterField filterVal" type="text" placeholder="Search by Name,Designation" onkeyup="currsearchFilter()">
							<?php }?>
								
							</form>
						</div>
						<div class="top-item">
							<form id="empFilter" method="post" action="">
								<select class="sortField sortVal" onchange="currsearchFilter()">
									<option value="ASC">Newest</option>
									<option value="DESC">Oldest</option>
								</select>
							</form>
						</div>
					</div>
						
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

			
		</section>
	</div>
<script type="text/javascript" src="../js/global.js"></script>
</body>
</html>