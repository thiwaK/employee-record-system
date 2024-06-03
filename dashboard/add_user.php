<?php
	include("../include/header.php");
	include("../include/db_connect.php");
	include("../include/validate_login.php");

	if (!in_array($usertype, $adminOnly)){
		echo "Unauthorized.";
		exit;
	}
	
	$result = $db_connect->query("SHOW TABLES LIKE 'employees'");
	if ($result->num_rows <= 0) {
		$employees_result = array();
		echo "<script>console.log('Empty: employees')</script>";
	} else {
		$employees_result = mysqli_query($db_connect, "SELECT * FROM employees");
		echo "<script>console.log('employees: ".$employees_result->num_rows."')</script>";
	}
?>

<div class="container-fluid">
	<div class="row ml-0 mr-0">
		<!-- Left sidebar for navigation -->
		<section class="col-lg-2 col-md-3 left border-right m-0" >
			<?php include("../include/sidebar.php"); ?>
		</section>

		<section class="col-md-8 col-lg-9 right border-left m-0">
			<div class="row">
				<div class="displaySuccess"></div>
				<div class="h2">Add User</div>

				<form id="adduser" class="clearfix" method="POST" action="">
					<h5 class="mt-5">User Details</h5>
					<hr>

					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
					</div>

					<div class="form-row">
						<div class="col">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
						</div>
						<div class="col">
							<label for="password2">Confirm Password</label>
							<input type="password" class="form-control" name="password2" id="password2" placeholder="Enter Password Again" required>
						</div>
						
					</div>

					<div class="form-row">
						<div class="col">
							<label for="accounttype">Account Type</label>
							<select class="form-select form-control" name="accounttype" id="accounttype" required>
								<option value="">Choose...</option>
								<option value="Admin">Admin</option>
								<option value="User">User</option>
							</select>
						</div>
						<div class="col">
							<label for="employee_number">Employee Number</label>
							<select class="form-select form-control" name="employee_number" id="employee_number" required>
								<option value="">Choose...</option>
								<?php
									if($employees_result->num_rows > 0){
										while($rec = mysqli_fetch_assoc($employees_result)){
											echo("<option value='".$rec["employee_number"]."'>".$rec["employee_number"]."</option>\n");
										}
									}    
								?>
							</select>
						</div>
					</div>


					<button type="submit" class="btn btn-primary mt-3">Submit</button>
				</form>
			</div>
		</section>
	</div>

	<?php include("../include/notification_model.php"); ?>


<script>
	Notify = new Notify();

	
	document.getElementById('adduser').addEventListener('submit', function(event) {
		event.preventDefault();

		if(validatePasswords()){
			let formData = new FormData(this);
			fetch('../API/add_user.php', {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.then(data => {
				
				if (data.response === 100) {
					Notify.Success("Success", "New user profile created successfully")
				} else {
					Notify.Warn("Error", "Failed to create new user profile. <strong>" + data.message + "</strong>")
				}
			})
			.catch(error => {
				console.error('Error:', error);
			});
			
		} else {
			Notify.Warn("Error", "Check your passwords.");

		}
		
		
	});

    function validatePasswords() {
        var password = document.getElementById("password").value;
        var password2 = document.getElementById("password2").value;

        if (password !== password2) {
            return false;
        }
        return true;
    }
</script>