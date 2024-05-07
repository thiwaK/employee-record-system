<?php

session_start();
ob_start();
 

/*
if(isset($_SESSION['username']) || isset($_SESSION['password'])){
$navbar = "1";
$logindisplay = "0";
$username = $_SESSION['id'];
//$password = $_SESSION['password'];
/*
$now = time();
$authed = isset($username);
if( $authed == "0" ){
    header('Location:../index.php');
}
// Checking the time now when home page starts.
if ($now > $_SESSION['expire']) {
    header('Location:../dashboard/logout.php');
        }
} 
else {
    header('Location:../index.php');
}

*/



backup_tables('localhost','root','','etc_db');//host-name,user-name,password,DB name

//echo "<br/>Done";
/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
$return = "";
$link =  new mysqli($host,$user,$pass,$name);

//get all of the tables
if($tables == '*')
{

$tables = array();
$result = mysqli_query('SHOW TABLES');
while($row = mysqli_fetch_row($result))
{
$tables[] = $row[0];
}
}
echo $tables;
}
/*else
{
$tables = is_array($tables) ? $tables : explode(',',$tables);
}
//cycle through
foreach($tables as $table)
{
$result = mysqli_query('SELECT * FROM '.$table);
$num_fields = mysqli_num_fields($result);
$return.= 'DROP TABLE '.$table.';';
$row2 = mysqli_fetch_row(mysqli_query('SHOW CREATE TABLE '.$table));
$return.= "\n\n".$row2[1].";\n\n";
for ($i = 0; $i < $num_fields; $i++)
{
while($row = mysqli_fetch_row($result))
{
$return.= 'INSERT INTO '.$table.' VALUES(';
for($j=0; $j<$num_fields; $j++)
{
$row[$j] = addslashes($row[$j]);
$row[$j] = ereg_replace("\n","\\n",$row[$j]);
if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
if ($j<($num_fields-1)) { $return.= ','; }
}
$return.= ");\n";
}
}
$return.="\n\n\n";
}

//save file
/*$handle = fopen('F:backups/db-backup-'.date('m-d-Y_hi').'.sql','w+');
// echo $return;

fwrite($handle,$return);
file_put_contents($return, $handle);
fclose($handle);
}
    header("Location:sys_backup.php?msg=1");*/

?>