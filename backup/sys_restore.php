<?php
session_start();
ob_start();
if(isset($_SESSION['username']) || isset($_SESSION['password'])){
$navbar = "1";
$logindisplay = "0";
$username = $_SESSION['id'];
$password = $_SESSION['password'];
$now = time();
$authed = isset($username, $password);
if( $authed == "0" ){
    header('Location:../../index.php');
}
// Checking the time now when home page starts.
if ($now > $_SESSION['expire']) {
    header('Location:../../logout.php');
        }
} 
else {
    header('Location:../../index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Restore The Database | TDSS for DOA</title>
        <link href="../../css/table.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            function validatefrm(){
             	    var nFile = document.getElementById('sql_file').value;
                    var file_ext = nFile.split('.').pop();
                    if(file_ext !== 'sql'){
			document.getElementById('error').innerHTML = "Please choose SQL file";
			document.getElementById('sql_file').focus();
			return false;
                    }
                    else if(nFile==""){
                        document.getElementById('error').innerHTML = "Please choose SQL file";
			document.getElementById('sql_file').focus();
			return false;
                    }
                    //else{       
                      //  document.getElementById('restore_db').submit();
                    //}
            }
        </script>
    </head>
    <body background="../../images/icons/header.jpg ">
        <?php
       // require_once 'backup_menu.php';
        echo '<br/>';
        if(isset($_GET ["msg"])){
        if($_GET ["msg"]==1){
            echo "<p style='color: #00ff00;' align='center'>Successfully Restored The Database!</p>"; 
        }
        else if ($_GET ["msg"]==2){
            echo "<p style='color: #ff0000;' align='center'>Error Occured.Database Restore Failed!</p>";
        }
        }
        ?>
        <fieldset style="margin-left: 20%; margin-right: 20%;">            
            <legend>Restore The Database</legend>
            <form id="restore_db" name="restore_db" method="post" action="sys_restore.php" onsubmit="return validatefrm();">
            <div id="error" style="color:#f00;" align="center"></div>
<table align="center" style="width:80%;" border="0">
    
<tr>
	<td><label>Select Database File</label></td>
        <td><input type="file" name="sql_file" id="sql_file"/></td>
        
</tr>
<tr> <td colspan="2">&nbsp;</td></tr>
        <tr>
        <td colspan="2" align="center">
            <input type="submit" value="Restore" name="btnrestore" onclick="return validatefrm();" style="width: 80px; height: 30px;"/>
            <input type="reset" value="Clear" onclick="confirm('Do you want to clear the fields');" style="width: 80px; height: 30px;"/></td>
    </tr>
</table>
            </form>
        </fieldset>
        <a href="../../home.php">Home</a>
        <br/>
<footer>
  <p align="center">&copy; All rights reserved by Department of Agriculture</p>
</footer>
    </body>
</html>

<?php
if(isset($_POST["btnrestore"])){
    $fname=$_POST["sql_file"];
// Name of the file
$filename = $fname;
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'db_trms';

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
header("Location:sys_restore.php?msg=1");
}
?>