<?php
	ob_start();
	include("../inc/header.php");

    include('../phpclasses/pagination.php');

    $limit = 10;
	    
	
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
	function viewrep(type){
	if(type==1){
             document.getElementById('frmemp_unit').submit();
	}
        else if(type==2){
		document.getElementById('frmemp_rep').submit();
	}
        else if(type==3){
		document.getElementById('frmemp_cadre_unit').submit();
	}
	
	

    }
</script>
<link rel="stylesheet" type="text/css" href="../css/style_table.css" />
	</head>
	<body>
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
			<li class="nav-item "><a href="../dashboard/past_employees.php"><span class="nav-icon"><i class="fa fa-times"></i></span>Past Employees</a></li>
			
			<li class="nav-item current"><a href="../dashboard/report_print.php"><span class="nav-icon"><i class="fa fa-print"></i></span>Employee reports</a></li>

			<?php if($usertype == "Admin" || $usertype =="superuser"){ ?>
				<li class="nav-item"><a href="../dashboard/add_employee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
			<?php 	} ?>
			<?php	if($usertype == "Admin"){?>
					<li class="nav-item"><a href="../backup/sys_backup.php"><span class="nav-icon"><i class="fa fa-database" aria-hidden="true"></i></span>Back up database</a></li>
					<li class="nav-item"><a href="../dashboard/add_user.php"><span class="nav-icon"><i class="fa fa-user"></i></span>Add User</a></li>
			<?php 	} ?>
			<li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
			<li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
		</ul>
	</section>
	<section class="contentSection right clearfix">
		<div class="container">
			<div class="wrapper employee_list clearfix">
				<div class="section_title">Generate  Employee  Reports</div>
					 <p class="heading2">Employee Detail Report</p>
				 <table border="1" width="100%" align="center">
                <tr>
              	<?php if($usertype == "Admin"){?>
                <form method="post" action="../reports/emp_unit_rep.php" name="frmemp_unit" id="frmemp_unit" target="_blank">
                   
                    <td><label>Employee details by Unit</label></td>
                    <td>
                    	
 					<select name="cmbunit_search" id="cmbunit_search" style="height: 30px;" >
						<option value="">--Select--</option>
						<option value="">Land and water resources management</option>
						<option value="">Administration</option>
						
							<!-- <?php
								require_once("../dashboard/conn.php");
								$dbobj = new dbConnection();
								$con = $dbobj->getCon();
	
						$sql2 = "SELECT DISTINCT unit_name FROM divisios_of_nrmc WHERE 1;";
						$result2 = mysqli_query($con,$sql2);
						$nor2 = $result2->num_rows;

	
						if($nor2>0){
								while($rec = mysqli_fetch_assoc($result2)){
										$unit_name = $rec["unit_name"];
									echo("<option value='".$rec["unit_name"]."'>".$unit_name."</option>");
		 								}
									}	
								mysqli_close($con);
								?>
    					</select>   -->
                        <input type="submit" value="Generate" onclick="viewrep(1);" style="padding-left:10px;width: 80px; height: 30px;"/>
                  
                    </td>
                </form>
                 <?php } ?>

                 <?php if($usertype == "superuser"){?>
                <form method="post" action="../reports/emp_rep.php" name="frmemp_rep" id="frmemp_rep" target="_blank">
                   
                    <td><label>Employee details </label></td>
                    <td>
                    	
 					<select name="cmbrep_search" id="cmbrep_search" style="height: 30px;" >
							<option value="">-- Select status --</option>
							<option value="Current Employee">Current Employee</option>
							<option value="Retired Employee">Retired Employee</option>
							<option value="Transferred Employee">Transferred Employee</option>
    					</select>  
                        <input type="submit" value="Generate" onclick="viewrep(2);" style="padding-left:10px;width: 80px; height: 30px;"/>
                  
                    </td>
                </form>
                 <?php } ?>
                </tr>

              
            </table>

	
	
			</div>
		</div>
		<div class="modal">
			<span class="close-modal">
				<img src="../images/times.png">
			</span>
			<div class="inner_section">
				<div id="record_container" class="record_container">
					<span class="print-modal" onclick="Clickheretoprint()">
						<img src="../images/print.png">
					</span>
					<div id="table">
					</div>
					<div class="printbtn_wrapper">
						<span class="printbtn"> Print</span>
					</div>
				</div>
			</div>
		</div>
		<div class="del_modal">
			<div class"inner_section">
				<div class="delcontainer">
					<div class="del_title">Delete Record</div>
					<div class="del_warning"></div>
					<div class="btnwrapper">
						<span class="delbtn yesbtn" data-id="">Yes</span>
						<span class="delbtn nobtn">No</span>
					</div>
				</div>
			</div>
		</div>
	</section>
<script type="text/javascript" src="../js/global.js"></script>
</body>
</html>



