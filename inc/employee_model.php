

            <div class="row">
				<div class="wrapper employee_list clearfix">
					<div class="section_title">All Current Employees</div>
					
					<div class="m-2 align-items-center">
						<!-- <div class="d-inline-block">
							<form id="empFilter" method="post" action="" class="form-inline">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Search by Name, Designation, Division" style="width: 350px;" onkeyup="searchFilter()">
								</div>
							</form>
						</div> -->
						
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
                        <th class="emp_id">Employee Number</th>
                        <th class="">Name</th>
                        <th class="">Designation</th>
                        <th class="">Unit</th>
                        <th class="">Service Category</th>
                        <!-- <th class="">Action</th> -->
                        </tr>
                    </thead>
                    <tbody id="displayempList" class="">
                        <?php
                        if($getempcount >= 1 ) {
                            while($fetch = mysqli_fetch_assoc($getemp)) {
                                // $id = $fetch['id'];
                                $emp_id = $fetch['employee_number'];
                                $name_with_initials = $fetch['name_with_initials'];
                                $designation = $fetch['designation'];
                                $division = $fetch['division_name'];
                                $service_category = $fetch['service_category'];

                                echo '<tr class="emp_row" data-id="' . $emp_id . '">';
                                    echo '<td class="emp_id">' . $emp_id . '</td>';
                                    echo '<td class="">' . $name_with_initials . '</td>';
                                    echo '<td class="">' . $designation . '</td>';
                                    echo '<td class="">' . $division . '</td>';
                                    echo '<td class="">' . $service_category . '</td>';
                                echo '</tr>';
                            }
                            echo $pagination->createLinks();
                        } else {
                            echo '<tr class="emp_item"><td colspan="6"> No employee record found </td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
				</div>
			</div>