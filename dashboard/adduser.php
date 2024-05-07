<?php 
	ob_start();
	include("../inc/db_connect.php");

	
	if(isset($_POST['submit'])){

		$firstname = mysqli_real_escape_string($db_connect, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db_connect, $_POST['lastname']);
		$realusername = mysqli_real_escape_string($db_connect, $_POST['username']);
		$password = mysqli_real_escape_string($db_connect, $_POST['password']);
		$usertype = mysqli_real_escape_string($db_connect, $_POST['usertype']);
		$userunit= mysqli_real_escape_string($db_connect, $_POST['userunit']);
	
		if($realusername && $password){										
			//Check if user already exists
			$u_check =  mysqli_query($db_connect, "SELECT username FROM users WHERE username = '$realusername' ");
								
			//Count the amount of rows where username = $username
			$check_user = mysqli_num_rows($u_check);
			ob_end_clean();	
			if ($check_user == 0) {

				$password = md5(md5($password).md5($realusername));
				$query = mysqli_query($db_connect, "INSERT INTO users (`user_id`, `firstname`, `lastname`, `username`, `password`, `accounttype`, `userunit`) VALUES ('NULL', '$firstname', '$lastname', '$realusername', '$password', '$usertype', '$userunit')");
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
		}
	}

?>