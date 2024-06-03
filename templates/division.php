
<?php include("../include/db_connect.php"); ?>
            <div class="row">
				<div class="wrapper employee_list clearfix">
					<h2 id="pg_header" class="header"></h2>
					
					<div class="m-2 align-items-center">

                        <!-- Search -->
                        <?php
                            $result = $db_connect->query("SHOW TABLES LIKE 'employees'");
                            if ($result) {
                                $employee_fields_result = mysqli_query($db_connect, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'employees' AND TABLE_SCHEMA = DATABASE() ORDER BY COLUMN_NAME ASC;");
                            } else {
                                $employee_fields_result = array();
                            }
                        ?>

                        <div class="justify-content-left">
                        <form class="form-inline" id="search_form">
                            <div class="form-group">
                                <input class="form-control mr-2" type="search" id="search" placeholder="Search" aria-label="Search">
                                <select class="form-select form-control mr-2" name="search_option" id="search_option">
                                    <option value="all">All</option>
                                    <?php
                                        if($employee_fields_result->num_rows > 0){
                                            $count = 0;
                                            while($rec = mysqli_fetch_assoc($employee_fields_result)){
                                                $columnName = $rec["COLUMN_NAME"];
                                                $columnName = str_replace('_', ' ', $columnName);
                                                $columnName = ucwords($columnName);
                                                echo("<option value='".$rec["COLUMN_NAME"]."'>".$columnName."</option>\n");
                                                $count++;
                                            }
                                        }	
                                    ?>
                                </select>
                                <button class="btn btn-outline-info" type="submit" id="saerch_button">Search</button>
                            </div>    
                        </form>
                        </div>

                        <!-- End Search -->

						<!-- <div class="d-inline-block">
						<form id="empFilter" method="post" action="" class="form-inline">
							<div class="form-group">
								<select class="form-control sortField sortVal" onchange="searchFilter()">
								<option value="ASC">Newest</option>
								<option value="DESC">Oldest</option>
								</select>
							</div>
							</form>
						</div> -->

					</div>
						
					<table class="table table-hover table-sm">
                    <thead class="thead-dark">
                        <th class="emp_id">E-Number</th>
                        <th class="">Name</th>
                        <th class="">Designation</th>
                        <th class="">Division</th>
                        <th class="">Service Category</th>
                        <!-- <th class="">Action</th> -->
                        </tr>
                    </thead>
                    <tbody id="divisionTableBody" class="">
                        
                    </tbody>
                </table>
				</div>
			</div>
