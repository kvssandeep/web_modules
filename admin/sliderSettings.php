<?php
ob_start();
session_start();
require_once '../dbconnect.php';

    $userLogged="False";
    // if session is not set this will redirect to login page
    if(isset($_SESSION['userType'])){
        $userType=$_SESSION['userType'];
        if($userType=="user")
            header("Location: ../login/index.php");
    }else{
        header("Location: ../login/index.php");
    }

    $width=500;
    $height=100;
    $timer = 5;
    $res=$dbLink->query("SELECT * FROM slidersettings");


    if($res->num_rows == 0) {

    }else{

        $userRow=$res->fetch_assoc();
        $width=$userRow['width'];
        $height=$userRow['height'];
        $timer = $userRow['timer'];
    }


?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Slider Settings</title>
  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css"> 
     <style>
    .dropdown {
    display: inline-block;
	margin:auto;
	float:left;
}

.dropdown-content {
    display: none;
    position: absolute;
	margin-left:auto;
    background-color: black;
    min-width: 16px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown:hover .dropdown-content {
    display: block;
}
    </style>
    
</head>

<body>
  <div class="container">	
        <div>
	       <ul class="anavul">
                <li class="anavli" >
                    <a href="#">Admin Panel</a>
                </li>
               <li >
                    <a href="index.php">Users</a>
                </li>
               <li class="dropdown"><a class="active" href="slider.php">Slider Images</a>
  <div class="dropdown-content">
    <a href="addImgSlider.php">Add Image</a>
    <a href="sliderSettings.php">Settings</a>
  </div>
               </li> 
               
                <li>
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
      <h1>Customization for Slider</h1>

      
      
      
      <section id="settings" class="sel">
        
        <p class="setting"><span>Width </span> <input type="number" id="width" value="<?php echo $width; ?>" min="500" max="1500" step="100" required > Px</p>
          
        <p class="setting"><span>Height </span> <input type="number" id="height" value="<?php echo $height; ?>" min="100" max="500" step="100" required > Px</p>
        
        <p class="setting"><span>Timer </span> <input type="number" id="timer" value="<?php echo $timer; ?>" min="1" max="10" step="1" required> Seconds</p>

        <p class="setting"><span> <a href="index.php">Cancel</a> </span><button class="button" onclick="saveChanges()">Save Changes</button> </p>
        
      </section>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
<script>
    function saveChanges(){
        var width= $('#width').val();
        var height = $('#height').val();
        var timer = $('#timer').val();
        //alert(userId);
        $.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=editSettings&width='+width+'&height='+height+'&timer='+timer,
					success:function(msg){
						if(msg.includes('ok')){
                            alert('Updates Successfully.');
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