    <?php
        // include("validate_login.php");
    ?>
    
    <div id="contextMenu" class="context-menu">
        <ul>
            <li onclick="viewDetails()">
                <i class="fa fa-address-card mr-2" aria-hidden="true"></i>View Details
            </li>

            <!-- <?php if($usertype == "Admin") {?> -->
                <li onclick="editRecord()">
                    <i class="fa fa-pencil mr-2" aria-hidden="true"></i>Edit
                </li>
            <!-- <?php }?> -->
            <!-- <?php if($usertype == "Admin") {?> -->
                <li onclick="deleteRecord()">
                    <i class="fa fa-trash mr-2" aria-hidden="true"></i>Delete
                </li>
            <!-- <?php }?> -->
        </ul>
    </div>