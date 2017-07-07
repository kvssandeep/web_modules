<?php
ob_start();
session_start();
require_once '../dbconnect.php';
	
	// if session is not set this will redirect to login page
    if(isset($_SESSION['userType'])){
        $userType=$_SESSION['userType'];
        if($userType=="user")
            header("Location: ../login/index.php");
    }else{
        header("Location: ../login/index.php");
    }
?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Slider Image Uploader</title>
  

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
               <li>
                    <a href="index.php">Users</a>
                </li>
                                
                
<li class="dropdown"><a class="active" href="slider.php">Slider Images</a>
  <div class="dropdown-content">
    <a href="addImgSlider.php">Add Image</a>
    <a href="sliderSettings.php">Settings</a>
  </div>
               </li>
                <li >
                    <a href="grid.php">Grid Images</a>
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
      <h1>Slider Image</h1>

      
      
      
      <section id="settings" class="sel">
          <form action="addSlider.php" method="post" enctype="multipart/form-data">
        
        <p>Your Details:</p>
        
          <p class="setting"><span>Image Name: </span> <input type="text" id="imagename" name=imagename></p>
        <p class="setting"><span>Image Size: </span> <select name="imgSize">
                    <option value="100%" selected="selected">100%</option>
                    <option value="90%" >90%</option>
                    <option value="80%" >80%</option>
                    <option value="70%" >70%</option>
                    <option value="60%" >60%</option>
                    <option value="50%" >50%</option>
                </select></p>
        
        <p class="setting"><span>Slider Image </span> <input class="button" type="file" name="uploaded_file"></p>
          
        <p class="setting"><span> <a href="slider.php">Cancel</a> </span><input class="button" type="submit" value="Upload file"> </p>
        </form>
      </section>
        
            
    
    </div><!-- @end #content -->
  </div><!-- @end #w -->
<script>
    function saveChanges(){
        var userId= <?php echo $userRow['userId']; ?>;
        var userType = $('#userType').val();
        var userPass = $('#pass').val();
        alert(userId);
        $.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=editUser&userId='+userId+'&userType='+userType+'&userPass='+userPass,
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