<?php
include("../include/db_connect.php");
include("../include/validate_login.php");

// $limit = 10;
$getempcount = 0;
$query_parameter = isset($_GET['q']) ? $_GET['q'] : null;
$search_option_parameter = isset($_GET['o']) ? $_GET['o'] : null;
$search_parameter = isset($_GET['s']) ? $_GET['s'] : null;

$search_option_parameter = strtolower($search_option_parameter);
$where_filter = null;


if(!is_null($search_parameter)){
    $search_parameter = mysqli_real_escape_string($db_connect, $search_parameter);
    if ($search_option_parameter === "all") {
        $where_filter = "appointment REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "class REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "designation REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "division_name REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "duties_assigned REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "name_denoted_initials REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "name_with_initials REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "nic REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "permanent_address REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "postal_address REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "service_category REGEXP '.*$search_parameter.*' OR ";
        $where_filter .= "status REGEXP '.*$search_parameter.*'";

        // Remove the last 'OR' to avoid syntax error
        $where_filter = rtrim($where_filter, " OR");
    } else {
        $where_filter = "$search_option_parameter REGEXP '.*$search_parameter.*'";
    }

}

// echo $where_filter."\n\n";


if ($query_parameter === 'current') {
    if(in_array($usertype, $allowedRoles)){

        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE status='Current Employee' ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE status='Current Employee' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
} elseif ($query_parameter === "all") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees ORDER BY employee_number DESC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE $where_filter ORDER BY employee_number DESC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }

} elseif ($query_parameter === "past") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE status='Retired Employee' OR status='Transferred Employee' ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE status='Retired Employee' OR status='Transferred Employee' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
// -------------------- Divisions ------------------------//
// Admin
} elseif ($query_parameter === "A") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Administration' ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Administration' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
// Soil Cons
} elseif ($query_parameter === "SC") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Soil Conservation' ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Soil Conservation' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
// Agro-clim
} elseif ($query_parameter === "A_C") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Agro-Climatology & Climate' ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Agro-Climatology & Climate' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
// Landuse
} elseif ($query_parameter === "LUP_G") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Land Use Planning & Geo-Informatics' ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Land Use Planning & Geo-Informatics' AND $where_filter ORDER BY employee_number ASC ");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
// Water and Land
} elseif ($query_parameter === "LaWRM") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Land and Water Resouces Management' ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Land and Water Resouces Management' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
// Knowledge
} elseif ($query_parameter === "KM") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Knowledge Management' ORDER BY employee_number ASC ");
            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Knowledge Management' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
} 

// ---------------------------- Users -----------------------//

elseif ($query_parameter === "all_users") {
    if(in_array($usertype, $allowedRoles)){
        if(is_null($where_filter)){
            $getemp = mysqli_query($db_connect, "SELECT 
                u.user_id,
                u.username,
                u.accounttype,
                u.employee_number,
                e.name_with_initials,
                e.name_denoted_initials,
                e.date_of_birth,
                e.nic,
                e.email,
                e.permanent_address,
                e.postal_address,
                e.appointment,
                e.salary_scale,
                e.phone_office,
                e.phone_mobile,
                e.division_name,
                e.service_category,
                e.class,
                e.designation,
                e.duties_assigned,
                e.joined_public_date,
                e.joined_nrmc,
                e.status,
                e.status_date,
                e.subject_to_desciplinary
            FROM 
                users u
            INNER JOIN 
                employees e
            ON 
                u.employee_number = e.employee_number
            ORDER BY 
                u.employee_number
            ASC ");

            $getempcount = mysqli_num_rows($getemp);
        } else {
            $getemp = mysqli_query($db_connect, "SELECT * FROM employees WHERE division_name='Knowledge Management' AND $where_filter ORDER BY employee_number ASC");
            $getempcount = mysqli_num_rows($getemp);
        }
    }
} else {
    $getemp = null;
}

if (is_null($getemp)){
    echo json_encode(new stdClass());
    return;
}

$rows = array();
while($fetch = mysqli_fetch_assoc($getemp)) {
    $rows[] = $fetch;
}

echo json_encode($rows);

?>