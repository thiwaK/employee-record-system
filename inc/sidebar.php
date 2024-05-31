<?php 
// include("validate_login.php");
include("db_connect.php");
?>
	<div class="sidebar">
		<div class="card bg-transparent text-center border-0">
			<img class="card-img-top mx-auto mt-3" style="max-width: 50%;" src="../images/logo.png" alt="NRMC Logo">
			<div class="card-body">
				<h5 class="card-title">Employee Record System</h5>
				<p class="card-text">Logged in as <?php echo $usertype; ?></p>
			</div>
		</div>

        <ul class="nav nav-pills flex-column pt-2 pl-3">
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
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/employees.php?q=all"><!-- span class="nav-icon"><i class="fa fa-users"></i></span -->All Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/employees.php?q=current"><!--span class="nav-icon"><i class="fa fa-check"></i></span -->Current Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/employees.php?q=past"><!--span class="nav-icon"><i class="fa fa-times"></i></span -->Past Employees</a></li>
                    <li class="nav-item submenu"><a class="nav-link" href="../dashboard/report_print.php"><!--span class="nav-icon"><i class="fa fa-print"></i></span -->Employee Reports</a></li>
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
					$get_divisions = mysqli_query($db_connect, "SELECT division_name FROM divisions ORDER BY division_id");
					$divisions_count = mysqli_num_rows($get_divisions);

					if($divisions_count >= 1 ) {
						while($fetch = mysqli_fetch_assoc($get_divisions)) {
							$division_name = $fetch['division_name'];
							echo '<li class="nav-item submenu"><a class="nav-link" href="../dashboard/' . $division_name . '">'. $division_name .'</a></li>';
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

	<script>

		$(".nav .nav-link").on("click", function(){
			$(".nav").find(".active").removeClass("active");
			$(this).addClass("active");
		});

		function getFileName(filePath) {
			var lastIndex = filePath.lastIndexOf("/");
			var fileName = filePath.substring(lastIndex + 1);
			return fileName;
		}

		document.addEventListener("DOMContentLoaded", function() {
			var path = window.location.pathname;
			path = path.replace(/\/$/, "");
			loc_array = window.location.href.split('/')

			// var path_file = getFileName(path).replace(/\s/g, "");
			var path_file = loc_array[loc_array.length - 1];

			var navLinks = document.querySelectorAll(".nav-link");
			// console.log("Current Path:" + path_file);

			if(path_file === ''){
				return;
			}

			navLinks.forEach(function(navLink) {
				var href = navLink.getAttribute("href");
				var href_file = getFileName(href);

				// console.log(href_file);

				if (href_file.includes(path_file)) {
					// console.log("Path matched:" + href_file);
					navLink.parentNode.classList.add('show'); // Active link indicator
					var parentLi = navLink.parentNode.parentNode;
					// console.log("Parent: " + parentLi.innerHTML);
					if (parentLi) {
						parentLi.classList.add("show");
					}

					var parentSubMenu = navLink.nextElementSibling;
					if (parentSubMenu && parentSubMenu.classList.contains("collapse")) {
						parentSubMenu.classList.add("show");
					}
				}
			});
		});

	</script>