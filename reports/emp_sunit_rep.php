<?php
ob_start();
include("../inc/header.php");

include('../phpclasses/pagination.php');
?>
<html>
<head>
	<title>Scholar details by units</title>
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

    $search_unit=@$_POST["cmbsunit_search"];
    $sql1="SELECT * 
          FROM divisions_of_nrmc
          WHERE  unit_name like '%$search_unit%' ";
    $result1=mysqli_query($con,$sql1);
    $row = mysqli_fetch_array($result1);
    $unitname= $row['unit_name'];

    $sql="SELECT * FROM employee";
    $result=mysqli_query($con,$sql);
    echo "<th colspan='2' align='center'>Non-scholar Details of  ".$unitname."</th>";


    echo "<table border='2' width='100%' id='result_table' contenteditable='false'>
        <colgroup span='3'></colgroup>
        <tr>
        <th rowspan='2'><label>Name with Initials</label></th>
        <th rowspan='2'><label>Designation</label></th>
        <th rowspan='2'><label>Date of Birth<label/></td>
        <th  rowspan='2'><label>Mobile No</label></th>
        <th  rowspan='2'><label>Permanent Address</label></th>
        <th rowspan='2'><label>NIC No</label></th>
        <th rowspan='2'><label>Email Address</label></th>
        <th  rowspan='2'><label>Appointment Date</label></th>
        <th  rowspan='2'><label>Service at DOA</label></th>
        <th  rowspan='2'><label>Highest Educational Qualification</label></th>
        <th  rowspan='2'><label>Service Category</label></th>
        <th  rowspan='2'><label>Permanent or Not</label></th>
        <th  rowspan='2'><label>subjected to desciplinary actions or not</label></th>
       
    </tr>";
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
        
            echo "<td>" . $row['name_with_initials'] . "</td>";
            echo "<td>" . $row['designation'] . "</td>";
            echo "<td>" . $row['date_of_birth'] . "</td>";
            echo "<td>" . $row['phone_mobile'] . "</td>";
            echo "<td>" . $row['permanent_address'] . "</td>";
            echo "<td>" . $row['id_number'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['joined_public_date'] . "</td>";
            echo "<td>" . $row['service_at_doa'] . "</td>";        
            //echo "<td>" . $row['highest_educational_qualification'] . "</td>";
            echo "<td>" . $row['service_category'] . "</td>";
            echo "<td>" .$row['appointment'] . "</td>";  
            echo "<td>" . $row['subject_to_desciplinary'] . "</td>";   
            echo "</tr>";
        }
        echo "</table>";
    } else {
    echo "No data found!";
  }
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