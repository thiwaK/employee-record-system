<?php

    //Include pagination class file
    include('../phpclasses/pagination.php');

    include('../inc/header.php');

    $action = mysqli_real_escape_String($db_connect, $_POST['action']);
    $limit = 10;

    if($action == "allemployee"){    
        $start = !empty($_POST['page'])?$_POST['page']:0;
        if($usertype == "Admin"){

        //set conditions for search
        $whereSQL = $orderSQL = '';
        $keywords = $_POST['keywords'];
        $sortBy = $_POST['sortBy'];
        if(!empty($keywords)){
            $whereSQL = "WHERE name_with_initials LIKE '%".$keywords."%' OR unit LIKE '%".$keywords."%' OR designation LIKE '%".$keywords."%'";
        }
    }


        if($usertype == "superuser"){

        //set conditions for search
        $whereSQL = $orderSQL = '';
        $keywords = $_POST['keywords'];
        $sortBy = $_POST['sortBy'];
        $query = $db_connect->query("SELECT userunit  FROM users WHERE username='$username'");
        $result = $query->fetch_assoc();
        $unitname = $result['userunit'];
    //  echo $unitname;
    
        if(!empty($keywords)){
            $whereSQL = "WHERE  employee.unit='$unitname' and (name_with_initials LIKE '%".$keywords."%' OR designation LIKE '%".$keywords."%')";
        }
    }
        if(!empty($sortBy)){
            $orderSQL = " ORDER BY id ".$sortBy;
        }else{
            $orderSQL = " ORDER BY id ASC ";
        }

         if($usertype == "Admin"){
        //get number of rows
        $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee ".$whereSQL.$orderSQL);
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['postNum'];

        //initialize pagination class
        $pagConfig = array(
            'currentPage' => $start,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'searchFilter'
        );
        $pagination =  new Pagination($pagConfig);


        //get rows
        $queryNum = mysqli_query($db_connect, "SELECT * FROM employee $whereSQL $orderSQL LIMIT $start, $limit");
        $queryNumcount = mysqli_num_rows($queryNum);
    }

    if($usertype == "superuser"){
        //get number of rows
        $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
            INNER JOIN users ON units_of_etc.unit_name=users.userunit ".$whereSQL.$orderSQL);
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['postNum'];

        //initialize pagination class
        $pagConfig = array(
            'currentPage' => $start,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'searchFilter'
        );
        $pagination =  new Pagination($pagConfig);


        //get rows
        $queryNum = mysqli_query($db_connect, "SELECT * FROM employee INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
            INNER JOIN users ON units_of_etc.unit_name=users.userunit $whereSQL $orderSQL LIMIT $start, $limit");
        $queryNumcount = mysqli_num_rows($queryNum);
    }
       
        if($queryNumcount >= 1 ){
                                while($fetch = mysqli_fetch_assoc($queryNum)){
                                   $id = $fetch['id'];
                                    $emp_id = $fetch['employee_id'];
                                    $name_with_initials = $fetch['name_with_initials'];
                                    $designation = $fetch['designation'];
                                    $unit = $fetch['unit'];
                                    $service_category = $fetch['service_category'];
                                    

                                    
                                       if($usertype == "Admin" or $usertype == "superuser" ){
                                            echo '                                      
                                                <li class="emp_item">
                                                   <div class="emp_column emp_id">'.$emp_id.'</div>
                                                    <div class="emp_column ">'.$name_with_initials.'</div>
                                                    <div class="emp_column">'.$designation.'</div>
                                                    <div class="emp_column">'.$unit.'</div>
                                                    <div class="emp_column ">'.$service_category.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
                                                            <li class="action_item action_edit" data-id="'.$id.'" title="Edit"><i class="fa fa-pencil-square-o"></i></li>
                                                            <li class="action_item action_delete" data-id="'.$id.'" title="Delete"><i class="fa fa-trash-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        } else {
                                            echo '                                      
                                                <li class="emp_item">
                                                   <div class="emp_column emp_id">'.$emp_id.'</div>
                                                    <div class="emp_column ">'.$name_with_initials.'</div>
                                                    <div class="emp_column">'.$designation.'</div>
                                                    <div class="emp_column">'.$unit.'</div>
                                                    <div class="emp_column ">'.$service_category.'</div>

                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';                                          
                                        }
                                    
                            
                                    
                                }
            echo $pagination->createLinks();
        } else {
            echo '<li class="emp_item"> No employee record found </li>';
        }
    }

    if($action == "currentemployees"){
        $start = !empty($_POST['page'])?$_POST['page']:0;        


        //set conditions for search
    if($usertype == "Admin"){
        $whereSQL = $orderSQL = '';
        $keywords = $_POST['keywords'];
        $sortBy = $_POST['sortBy'];
        if(!empty($keywords)){
             $whereSQL = "WHERE (name_with_initials LIKE '%".$keywords."%'  OR unit LIKE '%".$keywords."%' OR designation LIKE '%".$keywords."%') AND status='Current Employee'";
        } else {
            $whereSQL = "where status ='Current Employee'";
        }
    }
    if($usertype == "superuser"){
        $whereSQL = $orderSQL = '';
        $keywords = $_POST['keywords'];
        $sortBy = $_POST['sortBy'];
        $query = $db_connect->query("SELECT userunit  FROM users WHERE username='$username'");
        $result = $query->fetch_assoc();
        $unitname = $result['userunit'];
        if(!empty($keywords)){
             $whereSQL = "WHERE employee.unit='$unitname' and status='Current Employee' AND (name_with_initials LIKE '%".$keywords."%' OR designation LIKE '%".$keywords."%')";
        } else {
            $whereSQL = "where employee.unit='$unitname' and status ='Current Employee'";
        }
    }
        if(!empty($sortBy)){
            $orderSQL = " ORDER BY id ".$sortBy;
        }else{
            $orderSQL = " ORDER BY id ASC ";
        }

        //get number of rows
        if($usertype == "Admin"){
        $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee ".$whereSQL.$orderSQL);
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['postNum'];

        //initialize pagination class
        $pagConfig = array(
            'currentPage' => $start,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'currsearchFilter'
        );
        $pagination =  new Pagination($pagConfig);

        //get rows
        $queryNum = mysqli_query($db_connect, "SELECT * FROM employee $whereSQL $orderSQL LIMIT $start, $limit");
        $queryNumcount = mysqli_num_rows($queryNum);
    }
     if($usertype == "superuser"){
        $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
INNER JOIN users ON units_of_etc.unit_name=users.userunit ".$whereSQL.$orderSQL);
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['postNum'];

        //initialize pagination class
        $pagConfig = array(
            'currentPage' => $start,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'currsearchFilter'
        );
        $pagination =  new Pagination($pagConfig);


        //get rows
        $queryNum = mysqli_query($db_connect, "SELECT * FROM employee INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
INNER JOIN users ON units_of_etc.unit_name=users.userunit $whereSQL $orderSQL LIMIT $start, $limit");
        $queryNumcount = mysqli_num_rows($queryNum);
    }
       
        if($queryNumcount >= 1 ){
                                while($fetch = mysqli_fetch_assoc($queryNum)){
                                       $id = $fetch['id'];
                                    $emp_id = $fetch['employee_id'];
                                    $name_with_initials = $fetch['name_with_initials'];
                                    $designation = $fetch['designation'];
                                    $unit = $fetch['unit'];
                                    $service_category = $fetch['service_category'];
                                    

                                    
                                       if($usertype == "Admin" or $usertype == "superuser" ){
                                            echo '                                      
                                                <li class="emp_item">
                                                   <div class="emp_column emp_id">'.$emp_id.'</div>
                                                    <div class="emp_column ">'.$name_with_initials.'</div>
                                                    <div class="emp_column">'.$designation.'</div>
                                                    <div class="emp_column">'.$unit.'</div>
                                                    <div class="emp_column ">'.$service_category.'</div>

                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
                                                            <li class="action_item action_edit" data-id="'.$id.'" title="Edit"><i class="fa fa-pencil-square-o"></i></li>
                                                            <li class="action_item action_delete" data-id="'.$id.'" title="Delete"><i class="fa fa-trash-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        } else {
                                            echo '                                      
                                                <li class="emp_item">
                                                   <div class="emp_column emp_id">'.$emp_id.'</div>
                                                    <div class="emp_column ">'.$name_with_initials.'</div>
                                                    <div class="emp_column">'.$designation.'</div>
                                                    <div class="emp_column">'.$unit.'</div>
                                                    <div class="emp_column ">'.$service_category.'</div>

                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';                                          
                                        }
                                    
                            
                                    
                                }
            echo $pagination->createLinks();
        } else {
            echo '<li class="emp_item"> No employee record found </li>';
        }
    }

    if($action == "pastemployees"){
        $start = !empty($_POST['page'])?$_POST['page']:0;        

        //set conditions for search

            if($usertype == "Admin"){
        $whereSQL = $orderSQL = '';
        $keywords = $_POST['keywords'];
        $sortBy = $_POST['sortBy'];
        if(!empty($keywords)){
             $whereSQL = "WHERE (name_with_initials LIKE '%".$keywords."%'  OR unit LIKE '%".$keywords."%' OR designation LIKE '%".$keywords."%') AND status IN('Retired Employee','Transferred Employee')";
        } else {
            $whereSQL = "where status IN('Retired Employee','Transferred Employee')";
        }
    }
    if($usertype == "superuser"){
        $whereSQL = $orderSQL = '';
        $keywords = $_POST['keywords'];
        $sortBy = $_POST['sortBy'];
        $query = $db_connect->query("SELECT userunit  FROM users WHERE username='$username'");
        $result = $query->fetch_assoc();
        $unitname = $result['userunit'];
        if(!empty($keywords)){
             $whereSQL = "WHERE employee.unit='$unitname' AND employee.status IN('Retired Employee','Transferred Employee') AND (name_with_initials LIKE '%".$keywords."%' OR designation LIKE '%".$keywords."%')";
        } else {
            $whereSQL = "WHERE employee.unit='$unitname' and status IN('Retired Employee,Transferred Employee')";
        }
    }
        if(!empty($sortBy)){
            $orderSQL = " ORDER BY id ".$sortBy;
        }else{
            $orderSQL = " ORDER BY id ASC ";
        }

        //get number of rows
    if($usertype == "Admin"){
        $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee ".$whereSQL.$orderSQL);
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['postNum'];

        //initialize pagination class
        $pagConfig = array(
            'currentPage' => $start,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'pastsearchFilter'
        );
        $pagination =  new Pagination($pagConfig);


        //get rows
        $queryNum = mysqli_query($db_connect, "SELECT * FROM employee $whereSQL $orderSQL LIMIT $start, $limit");
        $queryNumcount = mysqli_num_rows($queryNum);
    }
    if($usertype == "superuser"){
        $queryNum = $db_connect->query("SELECT COUNT(*) as postNum FROM employee INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name
            INNER JOIN users ON units_of_etc.unit_name=users.userunit $whereSQL $orderSQL");
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['postNum'];

        //initialize pagination class
        $pagConfig = array(
            'currentPage' => $start,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'pastsearchFilter'
        );
        $pagination =  new Pagination($pagConfig);


        //get rows
        $queryNum = mysqli_query($db_connect, "SELECT * FROM employee INNER JOIN units_of_etc ON employee.unit=units_of_etc.unit_name INNER JOIN users ON units_of_etc.unit_name=users.userunit $whereSQL $orderSQL LIMIT $start, $limit");
        $queryNumcount = mysqli_num_rows($queryNum);
    }
       
        if($queryNumcount >= 1 ){
                                while($fetch = mysqli_fetch_assoc($queryNum)){
                                   
                                    $id = $fetch['id'];
                                    $emp_id = $fetch['employee_id'];
                                    $name_with_initials = $fetch['name_with_initials'];
                                    $designation = $fetch['designation'];
                                    $unit = $fetch['unit'];
                                    $service_category = $fetch['service_category'];
                    
                                   
                                      if($usertype == "Admin" or $usertype == "superuser" ){
                                            echo '                                      
                                                <li class="emp_item">
                                                    <div class="emp_column emp_id">'.$emp_id.'</div>
                                                    <div class="emp_column ">'.$name_with_initials.'</div>
                                                    <div class="emp_column">'.$designation.'</div>
                                                    <div class="emp_column">'.$unit.'</div>
                                                    <div class="emp_column ">'.$service_category.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
                                                            <li class="action_item action_edit" data-id="'.$id.'" title="Edit"><i class="fa fa-pencil-square-o"></i></li>
                                                            <li class="action_item action_delete" data-id="'.$id.'" title="Delete"><i class="fa fa-trash-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        } else {
                                            echo '                                      
                                                <li class="emp_item">
                                                     <div class="emp_column emp_id">'.$emp_id.'</div>
                                                    <div class="emp_column ">'.$name_with_initials.'</div>
                                                    <div class="emp_column">'.$designation.'</div>
                                                    <div class="emp_column">'.$unit.'</div>
                                                    <div class="emp_column ">'.$service_category.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" data-id="'.$id.'" title="View"><i class="fa fa-eye"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';                                          
                                        }
                           
                                }
            echo $pagination->createLinks();
        } else {
            echo '<li class="emp_item"> No employee record found </li>';
        }
    }

?>