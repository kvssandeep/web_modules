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
<html>
<head>
	<title>Masonry Grid</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="../jquery-1.11.3-jquery.min.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	
</head>
<script>
function loadImages1(){
	
   $.ajax({
            type: "POST",
            url: "functions.php",
            data: {action:"showimage1"},
            success: function(results){
               var div = document.getElementById('1');
               div.innerHTML = results;
               loadImages2();
            } 
            
        });

}

function loadImages2(){
	   $.ajax({
            type: "POST",
            url: "functions.php",
            data: {action:"showimage2"},
            success: function(results){
               var div = document.getElementById('2');
               div.innerHTML = results;
               loadImages3();
            } 
            
        });
}


function loadImages3(){
	   $.ajax({
            type: "POST",
            url: "functions.php",
            data: {action:"showimage3"},
            success: function(results){
               var div = document.getElementById('3');
               div.innerHTML = results;
               loadImages4();
            } 
            
        });
}

function loadImages4(){
	   $.ajax({
            type: "POST",
            url: "functions.php",
            data: {action:"showimage4"},
            success: function(results){
               var div = document.getElementById('4');
               div.innerHTML = results;
               loadImages5();
            } 
            
        });
}

function loadImages5(){
	   $.ajax({
            type: "POST",
            url: "functions.php",
            data: {action:"showimage5"},
            success: function(results){
               var div = document.getElementById('5');
               div.innerHTML = results;
         
            } 
            
        });
}

</script>

<body onload  = "loadImages1();">
    
<?php include '../index.php' ?>
    <div class="container">	
        <div>
	       <ul class="anavul">
                
               <li style="float:left;">
                    <a class="active" href="../MasonryGrid/index.php">MasonryGrid</a>
                </li>
               
                
               
               <li  style="float:center;color:cornsilk">
                   <h1 style="color:cornsilk;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $userRow['userName'];?>'s MasonryGrid</h1>
                         
               </li> 
            
            
                <li  style="float:right">
                   <a class="active" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
        </div>
        
    </div>
<div class="grid">
    <div style="float:left;">
  <div  id = '1' class="grid-item grid-item-1" style = "padding: 5px 5px 5px 5px;"></div>
  <div id = '2' class="grid-item grid-item--w2 grid-item--h2" style = "padding: 5px 5px 5px 5px;"></div>
  <div id = '3' class="grid-item grid-item--h3" style = "padding: 5px 5px 5px 5px;"></div>
  
  <div  id ='4' class="grid-item grid-item--w3" style = "padding: 5px 5px 5px 5px;"></div>
  <div id = '5' class="grid-item grid-item-2" style = "padding: 5px 5px 5px 5px;"></div>
  
</div>
    </div>
    





</body>
</html>
