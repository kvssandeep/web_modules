<?php
ob_start();
session_start();
require_once '../dbconnect.php';

	if(isset($_SESSION['userType'])){
        $userType=$_SESSION['userType'];
        if($userType=="user")
            header("Location: ../login/index.php");
    }else{
        header("Location: ../login/index.php");
    }

// it will never let you open index(login) page if session is set
if(isset($_GET['userId'])) {
    // Get the ID
    $id = intval($_GET['userId']);

    // Make sure the ID is in fact a valid ID
    if($id <= 0) {
        header("Location: index.php");
		exit;
    }
    else {}
}
$res=mysql_query("SELECT * FROM eusers WHERE userId=".$id);
if($res->num_rows == 0) {
        //header("Location: index.php");
		//exit;
}
$userRow=mysql_fetch_array($res);
$a=0;
if($userRow['userType']=="ADMIN"){
    $a=1;
}

?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
    <title><?php echo $userRow['userName']; ?>'s Profile</title>

  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="css/style.css"> 
</head>

<body>
  <div class="container">	
        <div>
	       <ul class="anavul">
                <li class="anavli" >
                    <a href="#">Welcome <?php echo $userName ?></a>
                </li>
               <li class="active anavli">
                    <a href="index.php">Users</a>
                </li>
                <li class="anavli" >
                    <a href="slider.php">Slider Images</a>
                </li>
                <li class="anavli" >
                    <a href="admin.php">Grid Images</a>
                </li>
               <li>
                    <a href="navigation.php">Navigation</a>
               </li>
            
                <li class="anavli"  style="float:right">
                   <a class="active" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
        </div>
        
    </div>
    <?php include '../index.php' ?>
  
  <div id="w">
    <div id="content" class="clearfix">
      <h1><?php echo strtoupper($userRow['userName']) ?></h1>

      
      
      
      <section id="settings" class="sel">
        <p>Your Details:</p>
        
          <p class="setting"><span>User ID </span> <?php echo $userRow['userId'] ?></p>
        <p class="setting"><span>User Email </span> <?php echo $userRow['userEmail'] ?></p> 
          <p class="setting"><span>User Status </span> <select id="userType" >
  <option value="USER" <?php if(!$a) echo 'selected="selected"' ; ?>>USER</option>
  <option value="ADMIN" <?php if($a) echo 'selected="selected"' ; ?> >ADMIN</option>
  
</select></p>
          
        <p class="setting"><span>Password </span><input type="password" id="pass"> </p>
        <p class="setting"><span> <a href="index.php">Cancel</a> </span><button class="button" onclick="saveChanges()">Save Changes</button> </p>
        
      </section>
    </div>
  </div>
<script>
    function saveChanges(){
        var userId= <?php echo $userRow['userId']; ?>;
        var userType = $('#userType').val();
        var userPass = $('#pass').val();
        $.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=editUser&userId='+userId+'&userType='+userType+'&userPass='+userPass,
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