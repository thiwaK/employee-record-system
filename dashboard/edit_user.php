	<?php

		include("../include/header.php");
		include("../include/db_connect.php");
		include("../include/validate_login.php");

		if (!in_array($usertype, $adminOnly)){
			echo "Unauthorized.";
			exit;
		}

		$result = $db_connect->query("SHOW TABLES LIKE 'users'");
		if ($result->num_rows <= 0) {
			$users_result = array();
			echo "<script>console.log('Empty: users')</script>";
		} else {
			$users_result = mysqli_query($db_connect, "SELECT * FROM positions");
			echo "<script>console.log('users: ".$users_result->num_rows."')</script>";
		}


		$result = $db_connect->query("SHOW TABLES LIKE 'employee_classes'");
		if ($result->num_rows <= 0) {
			$employee_classes_result = array();
			echo "<script>console.log('Empty: employee_classes')</script>";
		} else {
			$employee_classes_result = mysqli_query($db_connect, "SELECT * FROM employee_classes");
			echo "<script>console.log('employee_classes: ".$employee_classes_result->num_rows."')</script>";
		}

		$account_type_array = array(
			array("id" => 1, "name" => "Admin"),
			array("id" => 2, "name" => "User")
		);

		$employee_number = mysqli_real_escape_string($db_connect, $_GET['employee_number']);
		$username = mysqli_real_escape_string($db_connect, $_GET['username']);
		$account_type = mysqli_real_escape_string($db_connect, $_GET['account_type']);

		$result = mysqli_query($db_connect, "SELECT 
				u.user_id,
				u.username,
				u.accounttype,
				u.employee_number,
				e.name_with_initials,
				e.name_denoted_initials,
				e.date_of_birth,
				e.nic,
				e.email,
				e.permanent_address,
				e.postal_address,
				e.appointment,
				e.salary_scale,
				e.phone_office,
				e.phone_mobile,
				e.division_name,
				e.service_category,
				e.class,
				e.designation,
				e.duties_assigned,
				e.joined_public_date,
				e.joined_nrmc,
				e.status,
				e.status_date,
				e.subject_to_desciplinary
			FROM 
				users u
			INNER JOIN 
				employees e
			ON 
				u.employee_number = e.employee_number
			ORDER BY 
				u.employee_number
			ASC");

		// $query = "SELECT employee_number FROM users WHERE username = '$username' AND accounttype = '$account_type' AND employee_number = '$employee_number'";
		// $result = mysqli_query($db_connect, $query);

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
				<h2>Edit User Details</h2>
			</div>
			<div class="content">
				<form action="update_user.php" method="POST" id="edituser">

					<div class="form-group">
						<label for="username">Username</label>
						<input readonly type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $employee['username']; ?>">
					</div>

					<div class="form-row">
						<div class="col">
							<label for="password">Old Password</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
						</div>
						<div class="col">
							<label for="password2">New Password</label>
							<input type="password" class="form-control" name="password2" id="password2" placeholder="Enter New Password Again" required>
						</div>
						<div class="col">
							<label for="password_new">Confirm New Password</label>
							<input type="password" class="form-control" name="password_new" id="password_new" placeholder="Enter New Password Again" required>
						</div>
						
					</div>

					<div class="form-row">
						<div class="col">
							<label for="accounttype">Account Type</label>
							<select class="form-select form-control" name="accounttype" id="accounttype" required>
								<?php
									$value = $employee['accounttype'];
									for ($i = 0; $i < count($account_type_array); $i++) {
										if ($value == $account_type_array[$i]['name']){
											echo "<option selected value='" . $account_type_array[$i]['name'] . "'>" . $account_type_array[$i]['name'] . "</option>";
										} else {
											echo "<option value='" . $account_type_array[$i]['name'] . "'>" . $account_type_array[$i]['name'] . "</option>";
										}
									}
								?>
							</select>
						</div>
						<div class="col">
							<label for="employee_number">Employee Number:</label>
							<input readonly type="text" class="form-control" id="employee_number" name="employee_number" value="<?php echo $employee['employee_number']; ?>">
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

		document.getElementById('edituser').addEventListener('submit', function(event) {
			event.preventDefault();
			
			let formData = new FormData(this);
			fetch('../api/update_user.php', {
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