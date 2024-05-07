
<?php 
	ob_start();
	include("../inc/db_connect.php");

	


		$employee_id = mysqli_real_escape_string($db_connect, $_POST['employee_id']);
		$name_with_initials = mysqli_real_escape_string($db_connect, $_POST['name_with_initials']);
		$name_denoted_initials = mysqli_real_escape_string($db_connect, $_POST['name_denoted_initials']);
		$date_of_birth = mysqli_real_escape_string($db_connect, $_POST['date_of_birth']);
		//$gender = mysqli_real_escape_string($db_connect, $_POST['gender']);
		$id_number = mysqli_real_escape_string($db_connect, $_POST['id_number']);
		$email=mysqli_real_escape_string($db_connect, $_POST['email']);
		$appointment=mysqli_real_escape_string($db_connect, $_POST['appointment']);
		$permanent_address = mysqli_real_escape_string($db_connect, $_POST['permanent_address']);
		$s_scale=mysqli_real_escape_string($db_connect, $_POST['s_scale']);
		$postal_address = mysqli_real_escape_string($db_connect, $_POST['postal_address']);
		$phone_office = mysqli_real_escape_string($db_connect, $_POST['phone_office']);
		$phone_mobile = mysqli_real_escape_string($db_connect, $_POST['phone_mobile']);
		$unit = mysqli_real_escape_string($db_connect, $_POST['unit']);
		
		
		$service_category = mysqli_real_escape_string($db_connect, $_POST['service_category']);
		$class = mysqli_real_escape_string($db_connect, $_POST['class']);
		$designation = mysqli_real_escape_string($db_connect, $_POST['designation']);
		$duties_assigned = mysqli_real_escape_string($db_connect, $_POST['duties_assigned']);
		$joined_public_date = mysqli_real_escape_string($db_connect, $_POST['joined_public_date']);
		$joined_nrmc = mysqli_real_escape_string($db_connect, $_POST['joined_nrmc']);
		$status = mysqli_real_escape_string($db_connect, $_POST['status']);
		$status_date=mysqli_real_escape_string($db_connect, $_POST['status_date']);
		
		$subject_to_desciplinary= mysqli_real_escape_string($db_connect, $_POST['subject_to_desciplinary']);
		
	
										
		//Check if user already exists
		$id_check =  mysqli_query($db_connect, "SELECT employee_id FROM employee WHERE employee_id = '$employee_id' ");
								
		//Count the amount of rows where username = $username
		$check_id = mysqli_num_rows($id_check);
		ob_end_clean();	
		if ($check_id == 0) {

			$query = mysqli_query($db_connect, "INSERT INTO `employee` (`id`, `employee_id`, `name_with_initials`, `name_denoted_initials`, `date_of_birth`,`id_number`,`email`,`appointment`,`s_scale`, `permanent_address`, `postal_address`, `phone_office`, `phone_mobile`, `unit`, `service_category`, `class`, `designation`, `duties_assigned`, `joined_public_date`, `joined_nrmc`, `status`,`status_date`,`subject_to_desciplinary`) VALUES ('NULL', '$employee_id', '$name_with_initials', '$name_denoted_initials', '$date_of_birth','$id_number','$email','$appointment','$s_scale', '$permanent_address', '$postal_address', '$phone_office', '$phone_mobile', '$unit', '$service_category', '$class', '$designation', '$duties_assigned', '$joined_public_date', '$joined_nrmc', '$status','$status_date','$subject_to_desciplinary')");
			$querycount = mysqli_num_rows($query);

			ob_end_clean();			
			if($query){

				echo json_encode(array("status" => "Success"));
				exit();			
			} else {
				echo json_encode(array("status" => "failed"));
				exit();
			}

		} else {
			echo json_encode(array("status" => "exists"));
			exit();
		}
	

?>