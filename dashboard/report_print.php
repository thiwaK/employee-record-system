<?php
	ob_start();
	include("../inc/header.php");
    include('../phpclasses/pagination.php');
    $limit = 10;
?>




	<div class="container-fluid">
		<div class="row ml-0 mr-0">
		
			<!-- Left sidebar for navigation -->
			<section class="col-lg-2 col-md-3 left border-right m-0" >
				<?php include("../inc/sidebar.php"); ?>
			</section>

			<!-- Main content area -->
			<section class="col-md-8 col-lg-9 right border-left m-0">
				<div class="row">
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
			</section>
		</div>

<!-- <script type="text/javascript" src="../js/global.js"></script> -->
