<?php 
    include("db_connect.php");

    $usertype = '';

    session_start();
    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
   

    if(empty($username)){
        echo "You are being redirected...";
        header("Location: ./login_failed.php?error=failed_login");
    }

    $userdetails = mysqli_query($db_connect, "SELECT * FROM users WHERE username='$username' ");
    $userdetailscount = mysqli_num_rows($userdetails);

    if($userdetailscount == 1){
        while($fetch = mysqli_fetch_assoc($userdetails)){
            $id = $fetch['user_id'];
            // $firstname = $fetch['firstname'];
            // $lastname = $fetch['lastname'];
            $username = $fetch['username'];
            $usertype = $fetch['accounttype'];
        }
    }
?>
<!DOCTYPE>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>NRMC Employee Record System</title>
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
        <script language="javascript">
            function Clickheretoprint()
            { 
              var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
                  disp_setting+="scrollbars=yes,width=800, height=auto, top=25"; 
              var content_vlue = document.getElementById("record_container").innerHTML; 
              
              var docprint=window.open("","",disp_setting); 
               docprint.document.open(); 
               docprint.document.write('<html><head><title>Natural Resources Management Center | Employee Records System</title>'); 
               docprint.document.write('</head><link rel="stylesheet" type="text/css" href="../css/style.css" /><link href="../css/font-awesome.min.css" type="text/css" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"><body onLoad="self.print()" style="width: 800; font-size:12px; font-family:arial;">');          
               docprint.document.write(content_vlue);          
               docprint.document.write('</body></html>'); 
               docprint.document.close(); 
               docprint.focus(); 
            }
        </script>
</body>
</html>