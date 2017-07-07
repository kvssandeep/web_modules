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
    

include '../dbconnect.php';
$width=500;
$height=500;
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
<?php include 'functions.php' ?>
<!DOCTYPE html>
<html>
<title> Slider</title>
    <script src="../jquery-1.11.3-jquery.min.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/style.css"> 

<meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    .w3-animate-fading{-webkit-animation:fading 10s infinite;animation:fading 10s infinite}
        
    .w3-section{margin-top:50px!important;margin-bottom:10px!important}
        
    .mySlides{
        width: <?php echo $width; ?>px;
        height: <?php echo $height; ?>px;
        max-width:1500px;
        max-height:500px;
        margin: auto;
}
    .w3-content{margin:auto}
    @-webkit-keyframes fading{0%{opacity:0}50%{opacity:1}100%{opacity:0}}
@keyframes fading{0%{opacity:0}50%{opacity:1}100%{opacity:0}}
    </style>
<body>
<?php include '../index.php' ?>
    <div class="container">	
        <div>
	       <ul class="anavul">
                
               <li style="float:left">
                    <a class="active" href="../slider/index.php">Slider Image</a>
                </li>
               
                
                
               <li  style="float:center;color:cornsilk">
                   <h1 style="color:cornsilk;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $userRow['userName'];?>'s Slider</h1>
                         
               </li> 
            
            
                <li  style="float:right">
                   <a class="active" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
        </div>
        
    </div>
<div class="w3-content w3-section" style="max-width:1000px;max-height:100px">
  
    <?php echo getImage(); ?>
  
</div>
  

<script>
var myIndex = 0;
slider();

function slider() {
    var i;
    var stime=<?php echo $timer; ?> * 1000;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(slider, stime);    
}
</script>
 
</body>
</html>
