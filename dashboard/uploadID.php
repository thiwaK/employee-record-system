<?php 

if(isset($_POST)){

	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   	$rand_dir_name = substr(str_shuffle($chars), 0, 15);

 	$employee_photo = $_FILES['employee_ID'];
 	$employee_photo_name = $employee_photo["name"];

	echo json_encode(array("upload_filename" => $rand_dir_name."_".str_replace(array(" ", "(", ")", "--", "-(", ")-", "-",), "-", $employee_photo_name), "selected_filename" => $employee_photo_name ));
		

	move_uploaded_file($employee_photo["tmp_name"], "../uploads/employees_ids/".$rand_dir_name."_".str_replace(array(" ", "(", ")", "--", "-(", ")-", "-",), "-", $employee_photo_name));

}

?>