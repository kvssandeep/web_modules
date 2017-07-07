<?php
ob_start();
session_start();
require_once '../dbconnect.php';


if ( isset($_SESSION['user'])=="" ) {
    header("Location: index.php");
    exit;
}
$res=mysql_query("SELECT * FROM eusers WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
    

?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title><?php echo $userRow['userName']; ?>'s Profile</title>
   <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="css/style.css">
</head>

<body>
  <div class="container">	
        <div>
	       <ul class="anavul">
               <li  style="float:left">
               <a class="active" href="detail.php?deatil">profile</a>
               </li>
               <li  style="float:center;color:cornsilk">
                   <h1 style="color:cornsilk;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;welcome <?php echo $userRow['userName'];?></h1>
                         
               </li> 
                <li  style="float:right">
                   <a class="active" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
        </div>
        
    </div>
    <?php include '../index.php' ?>    
</body>
</html>