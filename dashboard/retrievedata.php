
<?php
    ob_start();
    //Include pagination class file
    include('../phpclasses/pagination.php');

    include('../inc/header.php');

    $action = mysqli_real_escape_String($db_connect, $_POST['action']);

    if($action == "retrieve"){    
        $record_id = mysqli_real_escape_String($db_connect, $_POST['record_id']);
        
        $getinfo = mysqli_query($db_connect, "SELECT * FROM employee WHERE id = '$record_id' ");
        $getinfocount = mysqli_num_rows($getinfo);

        if($getinfocount == 1){
            if($fetch = mysqli_fetch_assoc($getinfo)){
                 $employee_id = $fetch['employee_id'];
                $name_with_initials = $fetch['name_with_initials'];
                $name_denoted_initials = $fetch['name_denoted_initials'];
                $date_of_birth = $fetch['date_of_birth'];
                $id_number = $fetch['id_number'];
                $email=$fetch['email'];
                $appointment=$fetch['appointment'];
                $s_scale=$fetch['s_scale'];
                $permanent_address = $fetch['permanent_address'];
                $postal_address = $fetch['postal_address'];
                $phone_office = $fetch['phone_office'];
                $phone_mobile = $fetch['phone_mobile'];
                $unit = $fetch['unit'];
                $service_category = $fetch['service_category'];
                $class = $fetch['class'];
                $designation = $fetch['designation'];
                $duties_assigned = $fetch['duties_assigned'];
                $joined_public_date = $fetch['joined_public_date'];
                $joined_nrmc = $fetch['joined_nrmc'];
                $status = $fetch['status'];
                $status_date = $fetch['status_date'];
                $subject_to_desciplinary=$fetch['subject_to_desciplinary'];

                

                echo '<table class="table">
                        <tr class="table_row logo">
                            <td class="table_column logo">
                            <p>Employee Record System</p>
                            </td>
                        </tr>
                        <tr class="table_row table_part">
                            <td class="table_column" style="text-align:center">
                                PERSONAL DATA
                            </td>
                        </tr>
                        
                        <tr class="table_row">
                            <td class="table_column table_head l-column">
                                Name with Initials
                            </td>
                            <td class="table_column l-column">
                                '.$name_with_initials.'
                            </td><br>
                            
                        </tr>
                        <tr class="table_row">
                            <td class="table_column table_head l-column">
                                Name denoted by Initials
                            </td>
                            <td class="table_column l-column">
                                '.$name_denoted_initials.'
                            </td>
                        </tr>
                         <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                                Permanent Address
                            </td>
                             <td class="table_column table_head s-column">
                                Postal Address
                            </td>
                           
                            <td class="table_column s-column">
                                '.$permanent_address.'
                            </td>
                            <td class="table_column s-column">
                                '.$postal_address.'
                            </td>
                            
                        </tr>
                      
                         <tr class="table_row clearfix">
                             <td class="table_column table_head s-column">
                                Date of Birth
                            </td>
                            <td class="table_column table_head s-column">
                                National Identity Card No
                            </td>
                            <td class="table_column s-column">
                                '.$date_of_birth.'
                            </td>
                            <td class="table_column s-column">
                                '.$id_number.'
                            </td>
                        </tr>
                        <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                                Subject to desciplinary actions
                            </td>
                             <td class="table_column table_head s-column">
                                Division of NRMC
                            </td>
                            
                            <td class="table_column s-column">
                                '.$subject_to_desciplinary.'
                            </td>
                            <td class="table_column s-column">
                                '.$unit.'
                            </td>
                        </tr>
                        <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                                Telephone(Office)
                            </td>
                            <td class="table_column table_head s-column">
                                Telephone(mobile)
                            </td>
                             
                            <td class="table_column s-column">
                                '.$phone_office.'
                            </td>
                            <td class="table_column s-column">
                                '.$phone_mobile.'
                            </td>
                           
                         </tr>
                        <tr class="table_row clearfix">
                           
                            <td class="table_column table_head s-column">
                                Service Category
                            </td>
                           
                            <td class="table_column table_head s-column">
                                Designation
                            </td>
                             <td class="table_column s-column">
                               '.$service_category.'
                            </td>

                            <td class="table_column s-column">
                                '.$designation.'
                            </td>
                            
                        </tr>
                         <tr class="table_row clearfix">
                             <td class="table_column table_head s-column">
                                Class/Grade
                            </td>
                             <td class="table_column table_head s-column">
                                Salary scale
                             </td>
                             <td class="table_column s-column">
                                '.$class.'
                            </td>
                             <td class="table_column s-column">
                                '.$s_scale.'
                             </td>

                         </tr>
                            
                        <tr class="table_row clearfix">
                            <td class="table_column table_head s-column">
                                Duties Assigned
                            </td>
                            <td class="table_column table_head s-column">
                                Appointment permanent or not
                            </td>

                             <td class="table_column s-column">
                                '.$duties_assigned.'
                            </td>
                            <td class="table_column s-column">
                                '.$appointment.'
                            </td>
                        </tr>
                        <tr class="table_row clearfix">
                           <td class="table_column table_head s-column">
                                Appointment date
                            </td>
                            <td class="table_column table_head s-column">
                                Joined date of NRMC
                            </td>
                             

                             <td class="table_column s-column">
                                '.$joined_public_date.'
                            </td>
                            <td class="table_column s-column">
                                '.$joined_nrmc.'
                            </td>
                        </tr>
                         <tr class="table_row clearfix">
                           <td class="table_column table_head s-column">
                                Employment Status
                            </td>
                            <td class="table_column table_head s-column">
                                Employment Status Date
                            </td>
                            <td class="table_column s-column">
                                '.$status.'
                            </td>
                             <td class="table_column s-column">
                                '.$status_date.'
                            </td>
                            
                        </tr>
                        
                        
                        
                        </table>

                ';
            }
        } else {
            echo '

                 <tr class="table_row clearfix">
                    <td class="table_column l-column">
                        No Records Found in the system.
                    </td>
                </tr>
            ';
        }
    }

    if($action == "delete"){    
        $record_id = mysqli_real_escape_String($db_connect, $_POST['record_id']);

        $getinfo = mysqli_query($db_connect, "DELETE FROM `employee` WHERE `employee`.`id` = '$record_id' ");

        ob_end_clean();
        if($getinfo){
            echo json_encode(array("status"=>"success"));
            exit();
        } else {
            echo json_encode(array("status"=>"failed"));
            exit();
        }
    }

?>