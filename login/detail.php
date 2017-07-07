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
               
               <li style="float:left">
                    <a class="active" href="../login/detail.php">Profile Page</a>
                </li>
               
                
                
               <li  style="float:center;color:cornsilk">
                   <h1 style="color:cornsilk;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $userRow['userName'];?>'s profile</h1>
                         
               </li> 
               
                <li  style="float:right">
                   <a class="active" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
        </div>
        
    </div>
    <?php include '../index.php' ?>
<div id="w">
    <div id="content" class="clearfix">
      <section id="settings" class="sel">
        <h1 style="float:center">Profile Details</h1>
        <p class="setting"><span>Your ID </span> <?php echo $userRow['userId'] ?></p>
        <p class="setting"><span>Your Email </span> <?php echo $userRow['userEmail'] ?></p>
          <p class="setting"><span>UserName </span> <?php echo $userRow['userName'] ?></p>
        <p class="setting"><span>Change Password </span><input type="password" id="pass"> </p>
        <p class="setting"><span> <a href="profile.php">Cancel</a> </span><button class="button" onclick="saveChanges()">Save Changes</button> </p>
        
      </section>
    </div>
  </div>
<script>
    function saveChanges(){
        var userId= <?php echo $userRow['userId']; ?>;
        
        var userPass = document.getElementById("pass").value;
        if(userPass==""){
            alert("Password is empty");
            return 0;
        }
        
        $.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=editUser&userId='+userId+'&userPass='+userPass,
					success:function(msg){
						if(msg.includes('ok')){
                            alert('Updated Successfully.');
                            location.reload();
							
						}else{
							alert(msg);
						}
					}
				});
    }
    </script>
    </body>
</html>