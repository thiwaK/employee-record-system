<?php
	include("inc/header.php");
?>

<div class="container-fluid">
  <div class="row flex-grow-1">
    <!-- Left sidebar for navigation -->
    <div class="col-lg-3 col-md-4 bg-dark">
    
    <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
	  	<div class="collapse navbar-collapse" id="navbarVerticalCollapse">
            <div class="navbar-vertical-content scrollbar">
              <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    
                    <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="dashboard" >
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                            </span>
                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>

                    <ul class="nav collapse show" id="dashboard">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.html">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Default</span>
                                </div>
                            </a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard/analytics.html">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Analytics</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
			</ul>
			</div>
		</div>
	</nav>



    </div>

    <!-- Main content area -->
    <div class="col-lg-9 col-md-8">
      <div class="main-content">
        <!-- Main content goes here -->
        <h1>Main Content Area</h1>
        <p>This is where your main content will go.</p>

        <?php
        $get_divisions = mysqli_query($db_connect, "SELECT division_name FROM division ORDER BY division_id");
		$divisions_count = mysqli_num_rows($get_divisions);

        if($divisions_count >= 1 ) {
            while($fetch = mysqli_fetch_assoc($get_divisions)) {
                $division_name = $fetch['division_name'];

                echo '<p>' . $division_name . '</p>';
            }
        }

        ?>

      </div>
    </div>
  </div>

  <script>
  // Initialize collapse plugin
  var myCollapse = new bootstrap.Collapse(document.getElementById('dashboard'));
</script>


<?php
	include("inc/footer.php");
?>