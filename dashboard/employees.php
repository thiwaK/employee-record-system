<?php
	include("../inc/header.php");
    include('../phpclasses/pagination.php');

    $limit = 10;
	$getempcount = 0;
	$allowedRoles = array("Admin", "Manager", "User");

	$filter = isset($_GET['q']) ? $_GET['q'] : '';

	if ($filter === 'current') {
		if(in_array($usertype, $allowedRoles)){
			$getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE status='Current Employee' ORDER BY employee_number ASC LIMIT $limit");
			$getempcount = mysqli_num_rows($getemp);

		}
	} elseif ($filter === "all") {
		if(in_array($usertype, $allowedRoles)){
			$getemp = mysqli_query($db_connect, "SELECT * FROM employees ORDER BY employee_number DESC LIMIT $limit");
			$getempcount = mysqli_num_rows($getemp);

		}

	} elseif ($filter === "past") {
		if(in_array($usertype, $allowedRoles)){
			$getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE status='Retired Employee' OR status='Transferred Employee' ORDER BY employee_number ASC LIMIT $limit");
			$getempcount = mysqli_num_rows($getemp);

		}
		

	}

	if ($getempcount > 0){
		$queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employees WHERE status='Current Employee' LIMIT $limit");
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
			<?php include("../inc/sidebar.php"); ?>
		</section>

		<!-- Main content area -->
		<section class="col-md-8 col-lg-9 right border-left m-0">
			<?php include("../inc/employee_model.php"); ?>
		</section>
	</div>

	<?php include("../inc/context_menu.php"); ?>
    <?php include("../inc/employee_context_model.php"); ?>
