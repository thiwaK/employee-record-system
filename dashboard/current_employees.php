<?php
	include("../inc/header.php");
    include('../phpclasses/pagination.php');

    $limit = 10;
	$allowedRoles = array("Admin", "Manager", "User");
	    

	if(in_array($usertype, $allowedRoles)){


		$getemp = mysqli_query($db_connect, "SELECT * FROM employee WHERE status='Current Employee' ORDER BY employee_id ASC LIMIT $limit");
		$getempcount = mysqli_num_rows($getemp);

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

<div class="container-fluid">
	<div class="row ml-0 mr-0">
		<!-- Left sidebar for navigation -->
		<section class="col-lg-2 col-md-3 left border-right m-0" >
			<?php include("../inc/sidebar.php"); ?>
		</section>

		<!-- Main content area -->
		<section class="col-md-8 col-lg-9 right border-left m-0">
			<div class="row">

				<div class="wrapper employee_list clearfix">
					<div class="section_title">All Current Employees</div>
					
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
			</div>

			
		</section>
	</div>
<!-- <script type="text/javascript" src="../js/global.js"></script> -->
