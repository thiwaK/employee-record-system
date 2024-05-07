
<?php
	include("../inc/header.php");
										    
	if($usertype =="employee"){
        header("Location: ../dashboard");
    }

    if(isset($_GET['id'])){
    	$record_id = mysqli_real_escape_string($db_connect, $_GET['id']);

    	$getinfo = mysqli_query($db_connect, "SELECT * FROM employee WHERE id = '$record_id' ");
        $getinfocount = mysqli_num_rows($getinfo);

        if($getinfocount == 1){
            if($fetch = mysqli_fetch_assoc($getinfo)){
                $employee_id = $fetch['employee_id'];
                $name_with_initials = $fetch['name_with_initials'];
                $name_denoted_initials = $fetch['name_denoted_initials'];
                $date_of_birth = $fetch['date_of_birth'];
                $id_number = $fetch['id_number'];
                $email=$fetch['email'];
                $appointment=$fetch['appointment'];
                $s_scale=$fetch['s_scale'];
                $subject_to_desciplinary=$fetch['subject_to_desciplinary'];
                $permanent_address = $fetch['permanent_address'];
                $postal_address = $fetch['postal_address'];
                $phone_office = $fetch['phone_office'];
                $phone_mobile = $fetch['phone_mobile'];
                $unit = $fetch['unit'];
                $service_category = $fetch['service_category'];
                $class = $fetch['class'];
                $designation = $fetch['designation'];
                $duties_assigned = $fetch['duties_assigned'];
                $joined_public_date = $fetch['joined_public_date'];
                $joined_nrmc = $fetch['joined_nrmc'];
                $status = $fetch['status'];
                $status_date = $fetch['status_date'];
            }
        }
    } else {
    	echo "Invalid Approach";
    	exit();
    }

?>
	<section class="side-menu fixed left">
		<div class="top-sec">
			<div class="dash_logo">
				<img src="../images/logo.png">
			</div>	<br> <br>		
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
				
					<li class="nav-item"><a href="../backup/sys_backup.php"><span class="nav-icon"><i class="fa fa-database" aria-hidden="true"></i></span>Back up database</a></li>
				<li class="nav-item"><a href="../dashboard/add_user.php"><span class="nav-icon"><i class="fa fa-user"></i></span>Add User</a></li>
			<?php		} ?>
			<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
			<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
	</section>
	<section class="contentSection right clearfix">
		<div class="displaySuccess"></div>
		<div class="container">
			<div class="wrapper add_employee clearfix">
				<div class="section_title">Update Employee Records</div>
				<form id="editemployee" class="clearfix" method="" action="">
					<div class="section_subtitle">Personal Data</div>
					<input type="hidden" name="record_id" value="<?php echo $record_id ?>">
					<div class="input-box input-small left">
						<label for="employee_id">Employee ID</label><br>
						<input type="text" class="inputField emp_id" placeholder="Optional" name="employee_id" value="<?php echo $employee_id ?>">
						<div class="error empiderror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="name_with_initials">Name with initials</label><br>
						<input type="text" class="inputField name_with_initials" name="name_with_initials" value="<?php echo $name_with_initials ?>">
						<div class="error initialserror"></div>
					</div>
					
					<div class="input-box input-small left">
						<label for="name_denoted_initials">Name denoted by initials</label><br>
						<input type="text" class="inputField name_denoted_initials" name="name_denoted_initials" value="<?php echo $name_denoted_initials ?>">
						<div class="error nameerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="date_of_birth">Date of Birth</label><br>
						<input type="text"  class="datepicker inputField date_of_birth" name="date_of_birth"value="<?php echo $date_of_birth ?>">
						<div class="error  date_of_birtherror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="id_number">National ID Number</label><br>
						<input type="text" class="inputField id_number" name="id_number" value="<?php echo $id_number?>">
						<div class="error idnumbererror"></div>
					</div>

					<div class="input-box input-small right">
						<label for="subject_to_desciplinary">Subect to desciplinary actions??</label><br>
						<select class="inputField subject_to_desciplinary" name="subject_to_desciplinary" ><option value="<?php echo $subject_to_desciplinary ?>"><?php echo $subject_to_desciplinary ?></option>
							<option value="YES">YES</option>
							<option value="NO">NO</option>
						</select>
							<div class="error descerror"></div>
					</div>

					<div class="input-box input-small left">
						<label for="email">Email Address</label><br>
						<input type="text" class="inputField email" name="email" value="<?php echo $email ?>">
						<div class="error emailerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="unit">Divisions of NRMC</label><br>
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
						<input type="text" class="inputField permanent_address" name="permanent_address" value="<?php echo $permanent_address ?>">
						<div class="error resaddresserror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="postal_address">Postal Address</label><br>
						<input type="text" class="inputField postal_address" name="postal_address" value="<?php echo $postal_address ?>">
						<div class="error reslocationerror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="phone_office">Phone office</label><br>
						<input type="text" class="inputField phone_office" name="phone_office" value="<?php echo $phone_office ?>">
						<div class="error phoneerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="phone_mobile">Phone mobile</label><br>
						<input type="text" class="inputField phone_mobile" name="phone_mobile" value="<?php echo $phone_mobile ?>">
						<div class="error phone_m_error"></div>
					</div>
					
					<div class="input-box input-small left">
						<label for="designation">Designation</label><br>
						<select class="inputField designation" name="designation">
							<option value="<?php  echo $designation ?>"><?php echo $designation ?></option>
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
					<div class="input-box input-small right">
						<label for="service_category">Service Category</label><br>
						<input type="text" class="inputField service_category" name="service_category" value="<?php echo $service_category?>">
						<div class="error service_caterror"></div>
					</div>
					
					<div class="input-box input-small left">
						<label for="class">Class/Grade</label><br>
						<select class="inputField class" name="class">
								<option value="<?php  echo $class?>"><?php echo $class ?></option>
								<option value="sp">Special</option>
           						<option value="I">I</option>
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
							<option value="<?php echo $s_scale ?>"><?php echo $s_scale ?></option>
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
						<input type="text" class="inputField duties_assigned" name="duties_assigned" value="<?php echo $duties_assigned ?>">
						<div class="error duties_assignederror"></div>
					</div>

					<div class="input-box input-small right">
						<label for="joined_public_date">Date employed</label><br>
						<input type="text"  class="datepicker inputField joined_public_date" name="joined_public_date" value="<?php echo $joined_public_date ?>">
						<div class="error dateemployederror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="joined_etc">Date employed NRMC</label><br>
						<input type="text" class="datepicker inputField joined_nrmc" name="joined_nrmc" value="<?php echo $joined_etc ?>">
						<div class="error dateemployednrmcerror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="appointment">Is appointment permanent</label><br>
						<select class="inputField appointment" name="appointment">
							<option value="<?php echo $appointment ?>"><?php echo $appointment ?></option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
						<div class="error appointmenterror"></div>
					</div>
					<div class="input-box input-small left">
						<label for="status">Employment status</label><br>
						<select class="inputField status" name="status">
							<option value="<?php echo $status ?>"><?php echo $status ?></option>
							<option value="Current Employee">Current Employee</option>
							<option value="Retired Employee">Retired Employee</option>
							<option value="Transferred Employee">Transferred Employee</option>
						</select>
						<div class="error empstatuserror"></div>
					</div>
					<div class="input-box input-small right">
						<label for="status_date">Date of retirement or transfered</label><br>
						<input type="text" class="datepicker inputField status_date" name="status_date" placeholder="select date if transfered or Retired" value="<?php $status_date ?>">
						<div class="error datestatuschanged"></div>
					</div>
					<div class="input-box">
						<button type="submit" class="submitField">Update record</button>
					</div>
				</form>
			</div>
		</div>
	</section>
<script type="text/javascript" src="../js/global.js"></script>
</body>
</html>