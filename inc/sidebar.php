    <div class="sidebar">
		<div class="card bg-transparent text-center border-0">
			<img class="card-img-top mx-auto mt-3" style="max-width: 50%;" src="../images/logo.png" alt="NRMC Logo">
			<div class="card-body">
				<h5 class="card-title">Employee Record System</h5>
				<p class="card-text">Logged in as <?php echo $username; ?></p>
			</div>
		</div>

        <ul class="nav flex-column pt-2 pl-3">
            <!-- Dashboard -->
            <li class="nav-item">
				<a class="nav-link" href="../dashboard/"><span class="nav-link-icon"><i class="fa fa-desktop"></i></span><span class="nav-link-text ps-1">Dashboard</span></a>
			</li>

            <!-- Employees  -->
            <li class="nav-item">
				<a class="nav-link dropdown-toggle" href="#employeesSubMenu" aria-controls="employeesSubMenu" role="button" data-toggle="collapse" aria-expanded="true">
					<div class="d-flex align-items-center">
						<span class="nav-link-icon"><i class="fa fa-address-card"></i></span>
						<span class="nav-link-text ps-1">Employees</span>
					</div>
				</a>
                <ul class="nav collapse ml-4" id="employeesSubMenu" style="margin-top: 0;">
                    <li class="nav-item submenu"><a class="nav-link active" href="../dashboard/all_employee.php"><!-- span class="nav-icon"><i class="fa fa-users"></i></span -->All Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/current_employees.php"><!--span class="nav-icon"><i class="fa fa-check"></i></span -->Current Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/past_employees.php"><!--span class="nav-icon"><i class="fa fa-times"></i></span -->Past Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/report_print.php"><!--span class="nav-icon"><i class="fa fa-print"></i></span -->Employee reports</a></li>
                    <?php if($usertype == "Admin" || $usertype == "superuser") {?>
                        <li class="nav-item submenu"><a class="nav-link" href="../dashboard/add_employee.php"><!-- span class="nav-icon"><i class="fa fa-user-plus"></i></span -->Add Employee</a></li>
                    <?php }?>
                </ul>
            </li>

            <!-- Divisions -->
            <li class="nav-item">
				<a class="nav-link dropdown-toggle" href="#divisionsSubMenu" aria-controls="divisionsSubMenu" role="button" data-toggle="collapse" aria-expanded="false">
					<div class="d-flex align-items-center">
						<span class="nav-link-icon"><i class="fa fa-building"></i></span>
						<span class="nav-link-text ps-1">Divisions</span>
					</div>
				</a>
                <ul class="nav collapse ml-4 " id="divisionsSubMenu" style="margin-top: 0;">

				<?php
				$get_divisions = mysqli_query($db_connect, "SELECT division_name FROM division ORDER BY division_id");
				$divisions_count = mysqli_num_rows($get_divisions);

				if($divisions_count >= 1 ) {
					while($fetch = mysqli_fetch_assoc($get_divisions)) {
						$division_name = $fetch['division_name'];
						echo '<li class="nav-item submenu"><a class="nav-link active" href="../dashboard">'. $division_name .'</a></li>';
					}
				}

				?>
                </ul>
            </li>

            <!-- Preferences -->
            <li class="nav-item">
				<a class="nav-link dropdown-toggle" href="#preferencesSubMenu" aria-controls="preferencesSubMenu" role="button" data-toggle="collapse" aria-expanded="false">
					<div class="d-flex align-items-center">
						<span class="nav-link-icon"><i class="fa fa-gears"></i></span>
						<span class="nav-link-text ps-1">Preferences</span>
					</div>
				</a>
                <ul class="nav collapse ml-4" id="preferencesSubMenu" style="margin-top: 0;">
                    <li class="nav-item submenu"><a class="nav-link" href="../backup/sys_backup.php"><!-- span class="nav-icon"><i class="fa fa-database" aria-hidden="true"></i></span -->Backup Database</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/add_user.php"><!-- span class="nav-icon"><i class="fa fa-user"></i></span -->Add User</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/settings.php"><!-- span class="nav-icon"><i class="fa fa-cog"></i></span -->Settings</a></li>
					<!--  -->
				</ul>
            </li>

			<!-- Logout -->
            <li class="nav-item">
				<a class="nav-link" href="../dashboard/logout.php"><span class="nav-link-icon"><i class="fa fa-sign-out"></i></span><span class="nav-link-text ps-1">Sign Out</span></a>
			</li>
        </ul>
      </div>