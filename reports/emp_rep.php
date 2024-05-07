<?php
ob_start();
include("../inc/header.php");

include('../phpclasses/pagination.php');
?>
<html>
<head>
	<title>Employee details by status</title>
<script type="text/javascript">
function prnt(){
	document.getElementById("divpanel").style.display='none';
	window.print();
}
</script>
</head>

<body>
<table width="100%" border="0">

<tr>
    <td colspan="2" align="left"></td>
</tr>    
<?php
    require_once("../dashboard/conn.php");

    $dbobj = new dbConnection();
    $con = $dbobj->getCon();

    $search_status=@$_POST["cmbrep_search"];
    $query = $db_connect->query("SELECT unit_name  FROM divisions_of_nrmc WHERE unit_name='$unitname'");
    $result = $query->fetch_assoc();
    $unitname = $result['unit_name'];

    $sql="SELECT * 
          FROM employee INNER JOIN divisions_of_nrmc ON employee.unit=divisions_of_nrmc.unit_name
            INNER JOIN users ON divisions_of_nrmc.unit_name=users.unit_name
          WHERE employee.unit='$unitname' AND status like '%$search_status%'";
    $result=mysqli_query($con,$sql);
    echo"<th colspan='2' align='center'>".$search_status." Details of  ".$unitname."</th>";


    echo "<table border='2' width='100%'  contenteditable='false'>
        
        <th>
		<th><label>Name with Initials</label></th>
        <th><label>Designation</label></th>
        <th><label>Date of Birth<label/></td>
		<th><label>Mobile No</label></th>
        <th><label>Permanent Address</label></th>
        <th><label>NIC No</label></th>
        <th><label>Email Address</label></th>
        <th><label>Appointment Date</label></th>
        <th><label>NRMC joined date</label></th>
        <th><label>Duties Assigned</label></th>
        
        
       
        
</tr>";
    $i=1;
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
       echo "<td>".$i."</td>";
        echo "<td>" . $row['name_with_initials'] . "</td>";
        echo "<td>" . $row['designation'] . "</td>";
        echo "<td>" . $row['date_of_birth'] . "</td>";
        echo "<td>" . $row['phone_mobile'] . "</td>";
        echo "<td>" . $row['permanent_address'] . "</td>";
        echo "<td>" . $row['id_number'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['joined_public_date'] . "</td>";
        echo "<td>" . $row['joined_nrmc'] . "</td>";
        echo "<td>" . $row['duties_assigned'] . "</td>";       
      
        $i++;
        echo "</tr>";
    }    

    echo "</table>";
    ?>
<tr><td colspan="3" align="center"><hr /></td></tr>   
<tr><td colspan="4" align="center">
    <div id="divpanel" align="center">
<input type="button" value="Print" onclick="prnt();" style="width: 80px; height: 30px" />&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="Close" onclick="window.close();" style="width: 80px; height: 30px" />
</div></td></tr>
<tr>
<td colspan="2" align="center">
<hr />
<i></i>
</td>
</tr>
</table>
</body>
</html>