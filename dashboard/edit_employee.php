	<?php

		include("../include/header.php");
		include("../include/db_connect.php");
		include("../include/validate_login.php");

		if (!in_array($usertype, $adminOnly)){
			echo "Unauthorized.";
			exit;
		}

		$result = $db_connect->query("SHOW TABLES LIKE 'salary_scales'");
		if ($result->num_rows <= 0) {
			$salary_scales_result = array();
			echo "<script>console.log('Empty: salary_scales')</script>";
		} else {
			$salary_scales_result = mysqli_query($db_connect, "SELECT * FROM salary_scales");
			echo "<script>console.log('Salary Scale: ".$salary_scales_result->num_rows."')</script>";
		}


		$result = $db_connect->query("SHOW TABLES LIKE 'divisions'");
		if ($result->num_rows <= 0) {
			$divisions_result = array();
			echo "<script>console.log('Empty: divisions')</script>";
		} else {
			$divisions_result = mysqli_query($db_connect, "SELECT * FROM divisions");
			echo "<script>console.log('Divisions: ".$divisions_result->num_rows."')</script>";
		}


		$result = $db_connect->query("SHOW TABLES LIKE 'positions'");
		if ($result->num_rows <= 0) {
			$positions_result = array();
			echo "<script>console.log('Empty: positions')</script>";
		} else {
			$positions_result = mysqli_query($db_connect, "SELECT * FROM positions");
			echo "<script>console.log('positions: ".$positions_result->num_rows."')</script>";
		}


		$result = $db_connect->query("SHOW TABLES LIKE 'employee_classes'");
		if ($result->num_rows <= 0) {
			$employee_classes_result = array();
			echo "<script>console.log('Empty: employee_classes')</script>";
		} else {
			$employee_classes_result = mysqli_query($db_connect, "SELECT * FROM employee_classes");
			echo "<script>console.log('employee_classes: ".$employee_classes_result->num_rows."')</script>";
		}

		$yes_no_array = array(
			array("id" => 1, "name" => "Yes"),
			array("id" => 2, "name" => "No")
		);

		$emp_status_array = array(
			array("id" => 1, "name" => "Current Employee"),
			array("id" => 2, "name" => "Retired Employee"),
			array("id" => 3, "name" => "Transferred Employee")
		);

		$employee_number = $_GET['employee_number'];

		$query = "SELECT * FROM employees WHERE employee_number = '$employee_number'";
		$result = mysqli_query($db_connect, $query);

		if ($result->num_rows > 0) {
			$employee = mysqli_fetch_assoc($result);
		} else {
			echo "No employee found with the provided ID.";
			exit;
		}
	?>

	<style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .header, .content, .footer {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .header {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-row label {
            font-weight: bold;
        }
        .boxed-text {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>

<div class="container-fluid">
    <div class="row ml-0 mr-0">
    
        <!-- Left sidebar for navigation -->
        <section class="col-lg-2 col-md-3 left border-right m-0" >
            <?php include("../include/sidebar.php"); ?>
        </section>

        <!-- Main content area -->
        <section class="col-md-8 col-lg-9 right border-left m-0">
			<div class="header">
				<h2>Edit Employee Details</h2>
			</div>
			<div class="content">
				<form action="update_employee.php" method="POST" id="editemployee">
					
					<h5>Personal Details</h5>
					<div class="form-row">
						<div class="col">
							<label for="name_with_initials">Name with Initials:</label>
							<input type="text" class="form-control" id="name_with_initials" name="name_with_initials" value="<?php echo $employee['name_with_initials']; ?>">
						</div>
						<div class="col">
							<label for="name_denoted_initials">Name Denoted by Initials:</label>
							<input type="text" class="form-control" id="name_denoted_initials" name="name_denoted_initials" value="<?php echo $employee['name_denoted_initials']; ?>">
						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<label for="employee_number">Employee Number:</label>
							<input readonly type="text" class="form-control" id="employee_number" name="employee_number" value="<?php echo $employee['employee_number']; ?>">
						</div>
						<div class="col">
							<label for="salary_scale">Salary Scale:</label>
							<select class="form-select form-control" id="salary_scale" name="salary_scale">
								<?php
									if($salary_scales_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($salary_scales_result)){
											if ($employee['salary_scale'] == $rec['scale_name']){
												echo("<option selected value='".$rec["scale_name"]."'>".$rec["scale_name"]."</option>\n");
											} else {
												echo("<option value='".$rec["scale_name"]."'>".$rec["scale_name"]."</option>\n");
											}
											
										}
									}	
								?>
							</select>
							<!-- <input type="text" class="form-control" id="salary_scale" name="salary_scale" value="<?php echo $employee['salary_scale']; ?>"> -->
						</div>
						<div class="col">
							<label for="date_of_birth">Date of Birth:</label>
							<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $employee['date_of_birth']; ?>">
						</div>
						<div class="col">
							<label for="nic">National ID Number:</label>
							<input type="text" class="form-control" id="nic" name="nic" value="<?php echo $employee['nic']; ?>">
						</div>
					</div>

					<h5 class="mt-5">Contact Details</h5>
					<div class="form-row">
						<div class="col">
							<label for="permanent_address">Permanent Address:</label>
							<input type="text" class="form-control" id="permanent_address" name="permanent_address" value="<?php echo $employee['permanent_address']; ?>">
						</div>
						<div class="col">
							<label for="postal_address">Postal Address:</label>
							<input type="text" class="form-control" id="postal_address" name="postal_address" value="<?php echo $employee['postal_address']; ?>">
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="email">Email Address:</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $employee['email']; ?>">
						</div>
						<div class="col">
							<label for="phone_mobile">Phone Mobile:</label>
							<input type="text" class="form-control" id="phone_mobile" name="phone_mobile" value="<?php echo $employee['phone_mobile']; ?>">
						</div>
						<div class="col">
							<label for="phone_office">Phone Office:</label>
							<input type="text" class="form-control" id="phone_office" name="phone_office" value="<?php echo $employee['phone_office']; ?>">
						</div>
					</div>
					

					<h5 class="mt-5">Institution-related Details</h5>
					<div class="form-row">
						<div class="col">
							<label for="division_name">Division:</label>
							<select class="form-select form-control" id="division_name" name="division_name">
								<?php
									if($divisions_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($divisions_result)){
											if ($employee['division_name'] == $rec['division_name']){
												echo("\t\t\t\t<option selected value='".$rec["division_name"]."'>".$rec["division_name"]."</option>\n");
											} else {
												echo("\t\t\t\t<option value='".$rec["division_name"]."'>".$rec["division_name"]."</option>\n");
											}
										}
									}	
								?>
							</select>
						</div>
						<div class="col">
							<label for="designation">Designation:</label>
							<select class="form-select form-control" id="designation" name="designation">
								<?php
									if($positions_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($positions_result)){
											if ($employee['designation'] == $rec['position_name']){
												echo("\t\t\t\t<option selected value='".$rec["position_name"]."'>".$rec["position_name"]."</option>\n");
											} else {
												echo("\t\t\t\t<option value='".$rec["position_name"]."'>".$rec["position_name"]."</option>\n");
											}
											
										}
									}	
								?>
							</select>
						</div>
						<div class="col">
							<label for="class">Class/Grade:</label>
							<select class="form-select form-control" id="class" name="class">
								<?php
									if($employee_classes_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($employee_classes_result)){
											if ($employee['class'] == $rec['class_name']){
												echo("\t\t\t\t<option selected value='".$rec["class_name"]."'>".$rec['class_name']."</option>\n");
											} else {
												echo("\t\t\t\t<option value='".$rec['class_name']."'>".$rec['class_name']."</option>\n");
											}
											
										}
									}	
								?>
							</select>
						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<label for="joined_public_date">Date Employed:</label>
							<input type="date" class="form-control" id="joined_public_date" name="joined_public_date" value="<?php echo $employee['joined_public_date']; ?>">
						</div>
						<div class="col">
							<label for="joined_nrmc">Joined Date to NRMC:</label>
							<input type="date" class="form-control" id="joined_nrmc" name="joined_nrmc" value="<?php echo $employee['joined_nrmc']; ?>">
						</div>
						<div class="col">
							<label for="status_date">Date of Retirement or Transferred:</label>
							<input type="date" class="form-control" id="status_date" name="status_date" value="<?php echo $employee['status_date']; ?>">
						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<label for="subject_to_desciplinary">Subject to Disciplinary Actions:</label>
							<select class="form-select form-control" id="subject_to_desciplinary" name="subject_to_desciplinary">
								<?php
									$value = ($employee['subject_to_desciplinary'] == "1") ? "Yes" : "No";
									for ($i = 0; $i < count($yes_no_array); $i++) {
										if ($value == $yes_no_array[$i]['name']){
											echo "<option selected value='" . $yes_no_array[$i]['id'] . "'>" . $yes_no_array[$i]['name'] . "</option>";
										} else {
											echo "<option value='" . $yes_no_array[$i]['id'] . "'>" . $yes_no_array[$i]['name'] . "</option>";
										}
									}
								?>
							</select>
						</div>
						<div class="col">
							<label for="appointment">Is Appointment Permanent:</label>
							<select class="form-select form-control" id="appointment" name="appointment">
								<?php
									$value = ($employee['appointment'] == "1") ? "Yes" : "No";
									for ($i = 0; $i < count($yes_no_array); $i++) {
										if ($value == $yes_no_array[$i]['name']){
											echo "<option selected value='" . $yes_no_array[$i]['id'] . "'>" . $yes_no_array[$i]['name'] . "</option>";
										} else {
											echo "<option value='" . $yes_no_array[$i]['id'] . "'>" . $yes_no_array[$i]['name'] . "</option>";
										}
									}
								?>
							</select>
						</div>
						<div class="col">
							<label for="status">Employment Status:</label>
							<select class="form-select form-control" id="status" name="status">
								<?php
									for ($i = 0; $i < count($emp_status_array); $i++) {
										if ($employee['status'] == $emp_status_array[$i]['name']){
											echo "<option selected value='" . $emp_status_array[$i]['name'] . "'>" . $emp_status_array[$i]['name'] . "</option>";
										} else {
											echo "<option value='" . $emp_status_array[$i]['name'] . "'>" . $emp_status_array[$i]['name'] . "</option>";
										}
									}
								?>
							</select>

						</div>
					</div>

					
					<div class="form-row">
						<div class="col">
							<label for="service_category">Service Category:</label>
							<input type="text" class="form-control" id="service_category" name="service_category" value="<?php echo $employee['service_category']; ?>">
						</div>
						<div class="col">
							<label for="duties_assigned">Duties Assigned:</label>
							<input type="text" class="form-control" id="duties_assigned" name="duties_assigned" value="<?php echo $employee['duties_assigned']; ?>">
						</div>
					</div>

						<button type="submit" class="btn btn-primary mt-3">Update</button>
				</form>
			</div>
		</section>
            
    </div>

	<?php include("../include/notification_model.php");?>

	<script>

		Notify = new Notify();

		document.getElementById('editemployee').addEventListener('submit', function(event) {
			event.preventDefault();
			
			let formData = new FormData(this);
			fetch('../api/update_employee.php', {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.then(data => {
				
				if (data.response === 100) {
					Notify.Success("Success", "Employee profile successfully updated")
				} else {
					Notify.Warn("Error", "Failed to update employee profile. <strong>" + data.message + "</strong>")
				}
			})
			.catch(error => {
				console.error('Error:', error);
			});
		});


	</script>



<?php
	include("../include/footer.php");
?>