<?php

include("../inc/header.php");
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
            <?php include("../inc/sidebar.php"); ?>
        </section>

        <!-- Main content area -->
        <section class="col-md-8 col-lg-9 right border-left m-0">
                <div class="header">
                    <h2>Employee Details</h2>
                </div>
                <div class="content">
                    
                    <h5>Personal Details</h5>
                    <div class="form-row">
						<div class="col">
                            <label>Name with Initials:</label>
                            <div class="boxed-text"><?php echo $employee['name_with_initials']; ?></div>
						</div>
						<div class="col">
                            <label>Name Denoted by Initials:</label>
                            <div class="boxed-text"><?php echo $employee['name_denoted_initials']; ?></div>
						</div>
					</div>

                    <div class="form-row">
						<div class="col">
                            <label>Employee Number:</label>
                            <div class="boxed-text"><?php echo $employee['employee_number']; ?></div>
                        </div>
                        <div class="col">
                            <label>Date of Birth:</label>
                            <div class="boxed-text"><?php echo $employee['date_of_birth']; ?></div>
                        </div>
                        <div class="col">
                            <label>National ID Number:</label>
                            <div class="boxed-text"><?php echo $employee['nic']; ?></div>
                        </div>
                    </div>

                    <div class="form-row">
						<div class="col">
                            <label>Employee Number</label>
                            <div class="boxed-text"><?php echo $employee['employee_number']; ?></div>
						</div>
                        <div class="col">
                            <label>Salary Scale</label>
                            <div class="boxed-text"><?php echo $employee['salary_scale']; ?></div>
						</div>
					</div>

                    <h5 class="mt-5">Contact Details</h5>
                    <div class="form-row">
						<div class="col">
                            <label>Permanent Address:</label>
                            <div class="boxed-text"><?php echo $employee['permanent_address']; ?></div>
                        </div>
                        <div class="col">
                            <label>Postal Address:</label>
                            <div class="boxed-text"><?php echo $employee['postal_address']; ?></div>
                        </div>
                    </div>
                    <div class="form-row">
						<div class="col">
                            <label>Email Address:</label>
                            <div class="boxed-text"><?php echo $employee['email']; ?></div>
                        </div>
                        <div class="col">
                            <label>Phone Mobile:</label>
                            <div class="boxed-text"><?php echo $employee['phone_mobile']; ?></div>
                        </div>
                        <div class="col">
                            <label>Phone Office:</label>
                            <div class="boxed-text"><?php echo $employee['phone_office']; ?></div>
                        </div>
                    </div>


                    <h5 class="mt-5">Institution-related Details</h5>
                    <div class="form-row">
						<div class="col">
                        <label>Division:</label>
                        <div class="boxed-text"><?php echo $employee['division_name']; ?></div>
                        </div>
                        <div class="col">
                        <label>Designation:</label>
                        <div class="boxed-text"><?php echo $employee['designation']; ?></div>
                        </div>
                        <div class="col">
                        <label>Class/Grade:</label>
                        <div class="boxed-text"><?php echo $employee['class']; ?></div>
                        </div>
                    </div>

                    <div class="form-row">
						<div class="col">
                        <label>Date Employed:</label>
                        <div class="boxed-text"><?php echo $employee['joined_public_date']; ?></div>
                        </div>
                        <div class="col">
                        <label>Joined Date to NRMC:</label>
                        <div class="boxed-text"><?php echo $employee['joined_nrmc']; ?></div>
                        </div>
                        <div class="col">
                        <label>Date of Retirement or Transferred:</label>
                        <div class="boxed-text"><?php echo $employee['status_date']; ?></div>
                        </div>
                    </div>

                    <div class="form-row">
						<div class="col">
                            <label>Subject to Disciplinary Actions:</label>
                            <div class="boxed-text"><?php echo $employee['subject_to_desciplinary']; ?></div>
                        </div>
                        <div class="col">
                            <label>Is Appointment Permanent:</label>
                            <div class="boxed-text"><?php echo $employee['appointment']; ?></div>
                        </div>
                        <div class="col">
                            <label>Employment Status:</label>
                            <div class="boxed-text"><?php echo $employee['status']; ?></div>
                        </div>
                    </div>

                    
                    <div class="form-row">
						<div class="col">
                            <label>Service Category:</label>
                            <div class="boxed-text"><?php echo $employee['service_category']; ?></div>
                        </div>
                        <div class="col">
                            <label>Duties Assigned:</label>
                            <div class="boxed-text"><?php echo $employee['duties_assigned']; ?></div>
                        </div>
                    </div>
                </div>
            </section>
            
    </div>



<?php
	include("../inc/footer.php");
?>