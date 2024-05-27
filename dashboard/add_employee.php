<?php
	include("../inc/header.php");
	include('../phpclasses/pagination.php');

	
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
				<div class="displaySuccess"></div>
				<div class="h2">Add Employee</div>

				<form id="addemployee" class="clearfix" method="POST" action="">
					<h5 class="mt-5">Personal Details</h5>
					<hr>
					

					<div class="form-group">
						<label for="name_with_initials">Name with Initials</label>
						<input type="text" class="form-control" name="name_with_initials" id="name_with_initials" placeholder="Name with initials" not-required>
					</div>

					<div class="form-group">
						<label for="name_denoted_initials">Name Denoted by Initials</label><br>
						<input type="text" class="form-control" name="name_denoted_initials" placeholder="Name denoted by initials" not-required>
					</div>
					
					<div class="form-row">
						<div class="col">
							<label for="employee_id">Employee Number</label>
							<input type="text" class="form-control" name="employee_number" id="employee_number" placeholder="Employee number" not-required>
						</div>
						<div class="col">
							<label for="date_of_birth">Date of Birth</label>
							<input type="date" class="form-control" name="date_of_birth"  placeholder="Date of birth" not-required>
						</div>

						<div class="col">
							<label for="nic_number">National ID Number</label>
							<input type="text" class="form-control" name="nic_number" placeholder="NIC" not-required>
						</div>
					</div>

					<h5 class="mt-5">Contanct Details</h5>
					<hr>
					<div class="form-group">
						<label for="permanent_address">Permanent Address</label>
						<input type="text" class="form-control" name="permanent_address" placeholder="Permanent address" not-required>
					</div>

					<div class="form-group">
						<label for="postal_address">Postal Address</label>
						<input type="text" class="form-control" name="postal_address" placeholder="Postal address" not-required>
					</div>

					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" name="email" placeholder="E-Mail">
					</div>

					<div class="form-row">
						<div class="col">
							<label for="phone_mobile">Phone mobile</label><br>
							<input type="text" class="form-control" name="phone_mobile" placeholder="Mobile number" not-required>
						</div>

						<div class="col">
							<label for="phone_office">Phone office</label><br>
							<input type="text" class="form-control" name="phone_office" placeholder="Office phone number">
						</div>
						
						<div class="col">
							<label for="s_scale">Salary scale</label><br>
							<select class="form-select form-control" name="salary_scale">
								<option value="">Choose...</option>
								<?php
									if($salary_scales_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($salary_scales_result)){
											echo("<option value='".$rec["scale_id"]."'>".$rec["scale_name"]."</option>\n");
										}
									}	
								?>
							</select>
						</div>
					</div>

					<h5 class="mt-5">Institution-related Details</h5>
					<hr>
					
					<div class="form-row">
						<div class="col">
							<label  for="division">Division</label>
							<select class="form-select form-control " id="division" name="division_name">
							<option selected>Choose...</option>
								<?php
									if($divisions_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($divisions_result)){
												echo("\t\t\t\t<option value='".$rec["division_id"]."'>".$rec["division_name"]."</option>\n");
										}
									}	
								?>
							</select>
						</div>

						<div class="col">
							<label  for="designation">Designation</label>
							<select class="form-select form-control " name="designation">
								<option value="">Choose...</option>
								<?php
									if($positions_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($positions_result)){
											echo("<option value='".$rec["position_id"]."'>".$rec["position_name"]."</option>\n");
										}
									}
								?>
							</select>
						</div>

						<div class="col">
							<label  for="class">Class/Grade</label>
							<select class="form-select form-control " name="employee_class">
								<option value="">Choose...</option>
								<?php
									if($employee_classes_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($employee_classes_result)){
											echo("<option value='".$rec["class_id"]."'>".$rec["class_name"]."</option>\n");
										}
									}	
								?>

							</select>
						</div>

						
					</div>

					<div class="form-row">
						<div class="col">
							<label for="joined_public_date">Date employed</label>
							<input type="date" class="form-control" name="joined_public_date">
						</div>
						<div class="col">
							<label for="joined_nrmc">Joined date to NRMC</label>
							<input type="date" class="form-control" name="joined_nrmc">
						</div>
						<div class="col">
							<label for="status_date">Date of retirement or transfered</label>
							<input type="date" class="form-control" name="status_date" placeholder="Select date if transfered or retired">
						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<label for="subject_to_desciplinary">Subject to Desciplinary Actions?</label>
							<select class="form-select form-control " name="subject_to_desciplinary" >
								<option value="">Choose...</option>
								<option value="YES">YES</option>
								<option value="NO">NO</option>
							</select>
						</div>
						<div class="col">
							<label for="appointment">Is Appointment Permanent</label>
							<select class="form-select form-control " name="appointment">
								<option value="">Choose...</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
						<div class="col">
							<label for="status">Employment Status</label><br>
							<select class="form-select form-control " name="status">
								<option value="">Choose...</option>
								<option value="Current Employee">Current Employee</option>
								<option value="Retired Employee">Retired Employee</option>
								<option value="Transferred Employee">Transferred Employee</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="service_category">Service Category</label>
						<input type="text" class="form-control" name="service_category">
					</div>
					
					<div class="form-group">
						<label for="duties_assigned">Duties Assigned</label>
						<input type="text" class="form-control" name="duties_assigned">
					</div>

					
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>

				

			</div>
		</section>
	</div>

	<?php include("../inc/notification_model.php"); ?>



<script>

	Notify = new Notify();

	document.getElementById('addemployee').addEventListener('submit', function(event) {
		event.preventDefault();
		
		let formData = new FormData(this);
		fetch('../API/add_employee.php', {
			method: 'POST',
			body: formData
		})
		.then(response => response.json())
		.then(data => {
			
			if (data.response === 100) {
				Notify.Success("Success", "New employee profile created successfully")
			} else {
				Notify.Warn("Error", "Failed to create new employee profile. <strong>" + data.message + "</strong>")
			}
		})
		.catch(error => {
			console.error('Error:', error);
		});
	});

	
</script>

<?php
include("../inc/footer.php");
?>