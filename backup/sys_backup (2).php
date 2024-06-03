<?php
    include("../include/header.php");

    include('../phpclasses/pagination.php');

    if($usertype != "Admin"){
        header("Location: ../dashboard");
    }

?>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ETC Employee Record</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <link href="../css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.js"></script>
    </head>
<body>
    <section class="side-menu fixed left">
        <div class="top-sec">
            <div class="dash_logo">
                <img src="../images/logo.png">
            </div>          
            <p>Employee Record System</p><br>
            <p style="font-size:12px">Logged as <?php echo $username ?></p>
            </div>
        <ul class="nav">
            <li class="nav-item"><a href="../dashboard"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
            <li class="nav-item"><a href="../dashboard/current_employees.php"><span class="nav-icon"><i class="fa fa-check"></i></span>Current Employees</a></li>
            <li class="nav-item"><a href="../dashboard/past_employees.php"><span class="nav-icon"><i class="fa fa-times"></i></span>Past Employees</a></li>
            <li class="nav-item"><a href="../dashboard/report_print.php"><span class="nav-icon"><i class="fa fa-print"></i></span>Employee reports</a></li>
            <?php if($usertype == "Admin"){ ?>
                <li class="nav-item"><a href="../dashboard/add_employee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
                <li class="nav-item current"><a href="../dashboard/add_user.php"><span class="nav-icon"><i class="fa fa-user"></i></span>Add User</a></li>
            <?php       } ?>
            <li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
            <li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
        </ul>
    </section>

        <?php
       // require_once 'backup_menu.php';
        echo '<br/>';
        if(isset($_GET ["msg"])){
        if($_GET ["msg"]==1){
            echo "<p style='color: #00ff00;' align='center'>Successfully Backuped The Database!</p>"; 
        }
        else if ($_GET ["msg"]==2){
            echo "<p style='color: #ff0000;' align='center'>Error Occured.Database Backup Failed!</p>";
        }
        }
        $bdate = date("Y-m-d",time());

        ?>
        <fieldset style="margin-left: 20%; margin-right: 20%;">
            
            <legend>Backup The Database</legend>
            <form method="post" action="bkp_func_2.php">
<table align="center" style="width:80%;" border="0">
<tr>
	<td><label>Date</label></td>
        <td><input type="text" name="txtemp_id" value="<?php echo $bdate;?>" id="txtemp_id"/></td>
        
</tr>
<tr> <td colspan="2">&nbsp;</td></tr>
        <tr>
        <td colspan="2" align="center">
            <input type="submit" value="Backup" name="btnbackup" style="width: 80px; height: 30px;"/>
            <input type="reset" value="Clear" onclick="confirm('Do you want to clear the fields');" style="width: 80px; height: 30px;"/></td>
    </tr>
</table>
            </form>
        </fieldset>
              <br/>

    </body>
</html>