<?php 
	ob_start();
	include("../inc/db_connect.php");

	
		$record_id = mysqli_real_escape_string($db_connect, $_POST['record_id']);
		$employee_id = mysqli_real_escape_string($db_connect, $_POST['employee_id']);
		$name_with_initials = mysqli_real_escape_string($db_connect, $_POST['name_with_initials']);
		$name_denoted_initials = mysqli_real_escape_string($db_connect, $_POST['name_denoted_initials']);
		$date_of_birth = mysqli_real_escape_string($db_connect, $_POST['date_of_birth']);
		$subject_to_desciplinary=mysqli_real_escape_string($db_connect, $_POST['subject_to_desciplinary']);
		$id_number = mysqli_real_escape_string($db_connect, $_POST['id_number']);
		$email=mysqli_real_escape_string($db_connect, $_POST['email']);
		$permanent_address = mysqli_real_escape_string($db_connect, $_POST['permanent_address']);
		$postal_address = mysqli_real_escape_string($db_connect, $_POST['postal_address']);
		$phone_office = mysqli_real_escape_string($db_connect, $_POST['phone_office']);
		$phone_mobile = mysqli_real_escape_string($db_connect, $_POST['phone_mobile']);
		$unit = mysqli_real_escape_string($db_connect, $_POST['unit']);
		$appointment=mysqli_real_escape_string($db_connect, $_POST['appointment']);
		$service_category = mysqli_real_escape_string($db_connect, $_POST['service_category']);
		$class = mysqli_real_escape_string($db_connect, $_POST['class']);
		$designation = mysqli_real_escape_string($db_connect, $_POST['designation']);
		$duties_assigned = mysqli_real_escape_string($db_connect, $_POST['duties_assigned']);
		$joined_public_date = mysqli_real_escape_string($db_connect, $_POST['joined_public_date']);
		$joined_nrmc = mysqli_real_escape_string($db_connect, $_POST['joined_nrmc']);
		$status = mysqli_real_escape_string($db_connect, $_POST['status']);
		$status_date=mysqli_real_escape_string($db_connect, $_POST['status_date']);
		$s_scale=mysqli_real_escape_string($db_connect, $_POST['s_scale']);

		
	
		
	
		

		$query .= "UPDATE employee SET employee_id = '$employee_id', name_with_initials = '$name_with_initials', name_denoted_initials = '$name_denoted_initials', date_of_birth = '$date_of_birth', subject_to_desciplinary = '$subject_to_desciplinary', id_number = '$id_number',email='$email',appointment='$appointment',s_scale='$s_scale',permanent_address = '$permanent_address', postal_address = '$postal_address', phone_office = '$phone_office', phone_mobile = '$phone_mobile', unit = '$unit', service_category = '$service_category', class = '$class', designation = '$designation', duties_assigned = '$duties_assigned', joined_public_date = '$joined_public_date', joined_nrmc = '$joined_nrmc', status = '$status', status_date = '$status_date' WHERE id = '$record_id' ; ";

		ob_end_clean();			
		if(mysqli_multi_query($db_connect, $query)){

			echo json_encode(array("status" => "Success"));
			
			exit();			
		} else {
			echo json_encode(array("status" => "failed"));

			exit();
		}

?>