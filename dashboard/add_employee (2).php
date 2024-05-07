<?php
	include("../inc/header.php");
	
										   
	if($usertype == "employee"){
        header("Location: ../dashboard");
    }

?>
	<section class="side-menu fixed left">
		<div class="top-sec">
			<div class="dash_logo">
				<img src="../images/logo.png">
			</div>			
			<p>Employee Record System</p><br>
			<p style="font-size:12px">Logged as <?php echo $username ?></p>
		</div>
		<ul class="nav">
			<li class="nav-item"><a href="../dashboard"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
			<li class="nav-item"><a href="../dashboard/current_employees.php"><span class="nav-icon"><i class="fa fa-check"></i></span>Current Employees</a></li>
			<li class="nav-item"><a href="../dashboard/past_employees.php"><span class="nav-icon"><i class="fa fa-times"></i></span>Past Employees</a></li>
			<li class="nav-item"><a href="../dashboard/report_print.php"><span class="nav-icon"><i class="fa fa-print"></i></span>Employee reports</a></li>
			<li class="nav-item current"><a href="../dashboard/add_employee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
			<?php if($usertype == "Admin"){ ?>
				
				<li class="nav-item"><a href="../dashboard/add_user.php"><span class="nav-icon"><i class="fa fa-user"></i></span>Add User</a></li>
				<li class="nav-item"><a href="../backup/sys_backup.php"><span class="nav-icon"><i class="fa fa-database" aria-hidden="true"></i></span>Back up database</a></li>
				

			<?php		} ?>

			<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
			<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
	</section>
	<section class="contentSection right clearfix">
		<div class="displaySuccess"></div>
		<div class="container">
			<div class="wrapper add_employee clearfix">
				<div class="section_title">Add Employee</div>
				<form id="addemployee" class="clearfix" method="" action="">
					<div class="section_subtitle">Personal Data</div>
					<div class="input-box input-small left">
						<label for="employee_id">Employee ID</label><br>
						<input type="text" class="inputField employee_id" placeholder="salary No" name="employee_id">
						<div class="error empiderror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="name_with_initials">Name with initials</label><br>
						<input type="text" class="inputField name_with_initials" name="name_with_initials">
						<div class="error initialserror"></div>
					</div>
					
					<div class="input-box input-small left">
						<label for="name_denoted_initials">Name denoted by initials</label><br>
						<input type="text" class="inputField name_denoted_initials" name="name_denoted_initials">
						<div class="error nameerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="date_of_birth">Date of Birth</label><br>
						<input type="text" class="datepicker inputField date_of_birth" name="date_of_birth">
						<div class="error date_of_birtherror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="id_number">National ID Number</label><br>
						<input type="text" class="inputField id_number" name="id_number">
						<div class="error idnumbererror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="subject_to_desciplinary">Subect to desciplinary actions??</label><br>
						<select class="inputField subject_to_desciplinary" name="subject_to_desciplinary" ><option value="">-- Select desciplinary status --</option>
							<option value="YES">YES</option>
							<option value="NO">NO</option>
						</select>
							<div class="error descerror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="email">Email Address</label><br>
						<input type="text" class="inputField email" name="email">
						<div class="error emailerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="unit">Unit of ETC</label><br>
						<select class="inputField unit" name="unit">
							<option value="">-- Select Unit --</option>
							<?php

								require_once("conn.php");
								$dbobj = new dbConnection();
								$con = $dbobj->getCon();
	
								$sql = "SELECT DISTINCT unit_name FROM divisions_of_nrmc WHERE 1;";
								$result = mysqli_query($con,$sql);
								$nor = $result->num_rows;
	
								if($nor>0){
								while($rec = mysqli_fetch_assoc($result)){
										$unit_name = $rec["unit_name"];
										echo("<option value='".$rec["unit_name"]."'>".$unit_name."</option>");
													}
												}	
									mysqli_close($con);?>

								</select>
						<div class="error empuniterror"></div>
					</div>

					<div class="input-box input-small left">
						<label for="permanent_address">Permanent Address</label><br>
						<input type="text" class="inputField permanent_address" name="permanent_address">
						<div class="error resaddresserror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="postal_address">Postal Address</label><br>
						<input type="text" class="inputField postal_address" name="postal_address">
						<div class="error reslocationerror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="phone_office">Phone office</label><br>
						<input type="text" class="inputField phone_office" name="phone_office">
						<div class="error phoneerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="phone_mobile">Phone mobile</label><br>
						<input type="text" class="inputField phone_mobile" name="phone_mobile">
						<div class="error phone_m_error"></div>
					</div>
					
						
					<div class="input-box input-small right">
						<label for="service_category">Service Category</label><br>
						<input type="text" class="inputField service_category" name="service_category">
						<div class="error service_caterror"></div>
						
					</div>
					
					<div class="input-box input-small left">
						<label for="designation">Designation</label><br>
						<select class="inputField designation" name="designation">
							<option value="">-- Select designation --</option>
							<?php

								require_once("conn.php");
								$dbobj = new dbConnection();
								$con = $dbobj->getCon();
	
								$sql = "SELECT DISTINCT position FROM post WHERE 1;";
								$result = mysqli_query($con,$sql);
								$nor = $result->num_rows;
	
								if($nor>0){
								while($rec = mysqli_fetch_assoc($result)){
									$position = $rec["position"];
									echo("<option value='".$rec["position"]."'>".$position."</option>");
										}
								}	
							mysqli_close($con);?>

    						</select>
						<div class="error designationerror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="class">Class/Grade</label><br>
						<select class="inputField class" name="class">
								<option value="">-- Select class/Grade --</option>
								<option value="sp-">Special</option>
           						<option value="I-">I</option>
           					 	<option value="II">II</option>
            					<option value="III">III</option>
           					 	<option value="I-II">I-II</option>
           					 	<option value="I-III">I-III</option>
           					 	<option value="2-I">2-I</option>
           					 	<option value="2-II">2-II</option>
            					<option value="3-I">3-I</option>
            					<option value="3-II">3-II</option>
            					<option value="3-III">3-III</option>
							
						</select>
						<div class="error classerror"></div>
					</div>

					<div class="input-box input-small right">
						<label for="s_scale">Salary scale</label><br>
						<select class="inputField s_scale" name="s_scale">
							<option value="">-- Select salary scale --</option>
							<?php

								require_once("conn.php");
								$dbobj = new dbConnection();
								$con = $dbobj->getCon();
	
								$sql = "SELECT DISTINCT s_scale FROM salary_scale WHERE 1;";
								$result = mysqli_query($con,$sql);
								$nor = $result->num_rows;
	
								if($nor>0){
								while($rec = mysqli_fetch_assoc($result)){
								$s_scale = $rec["s_scale"];
								echo("<option value='".$rec["s_scale"]."'>".$s_scale."</option>");
										}
									}	
								mysqli_close($con);?>
						</select>
						<div class="error s_scaleerror"></div>
					</div>


					<div class="input-box input-small left">
						<label for="duties_assigned">Duties Assigned</label><br>
						<input type="text" class="inputField duties_assigned" name="duties_assigned">
						<div class="error duties_assignederror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="joined_public_date">Date employed</label><br>
						<input type="text" class="datepicker inputField joined_public_date" name="joined_public_date">
						<div class="error dateemployederror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="joined_etc">Joined date to ETC</label><br>
						<input type="text" class="datepicker inputField joined_etc" name="joined_etc">
						<div class="error dateemployedetcerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="appointment">Is appointment permanent</label><br>
						<select class="inputField appointment" name="appointment">
							<option value="">-- Select yes/no --</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
						<div class="error appointmenterror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="status">Employment status</label><br>
						<select class="inputField status" name="status">
							<option value="">-- Select status --</option>
							<option value="Current Employee">Current Employee</option>
							<option value="Retired Employee">Retired Employee</option>
							<option value="Transferred Employee">Transferred Employee</option>
						</select>
						<div class="error empstatuserror"></div>
					</div>
					
					<div class="input-box input-small right">
						<label for="status_date">Date of retirement or transfered</label><br>
						<input type="text" class="datepicker inputField status_date" name="status_date" placeholder="select date if transfered or Retired">
						<div class="error datestatuschanged"></div>
					</div>
					
					<div class="input-box">
						<button type="submit" class="submitField">Add record</button>
					</div>
				</form>
			</div>
		</div>
	</section>
<script type="text/javascript" src="../js/global.js"></script>
</body>
</html>