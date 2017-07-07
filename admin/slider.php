<?php
require_once '../dbconnect.php';
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
?>
<?php include 'functions.php' ?>
<!DOCTYPE html>

<html>
<head>
    <title>Slider Images</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" >
    
    
        <script src="../jquery-1.11.3-jquery.min.js"></script>
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
<body bgcolor="">

    
    <div class="container">
			
	       <ul class="anavul">
                <li style=" font-size:20px;">
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
                    <a href="admin.php">Grid Images</a>
                </li>
               <li>
                    <a href="navigation.php">Navigation</a>
               </li>
                
                <li  style="float:right">
                    <a class="active" href="logout.php?logout">Sign Out</a>
                    
                </li>
            </ul>
    </div>
    <?php include '../index.php' ?>
    
    <div class="container">
        <?php echo getSliderImgs(); ?>
    </div>
    <script>
    function deleteImg(id){
                $.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=delSlider&userId='+id,
					success:function(msg){
                        
                    if(msg.includes('ok')){
    				        alert('Image Deleted Successfully.');
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