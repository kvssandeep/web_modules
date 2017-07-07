<html>
<head>
  <title>Masonry Grid</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="../jquery-1.11.3-jquery.min.js" ></script>
        <link rel="stylesheet" type="text/css" href="gridcss/styles.css">
	<link rel="stylesheet" type="text/css" href="gridcss/style.css" />
    <!--addsliderImgCSS-->
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
<script>
function loadImages1(){
  
   $.ajax({
            type: "POST",
            url: "adminfunction.php",
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
            url: "adminfunction.php",
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
            url: "adminfunction.php",
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
            url: "adminfunction.php",
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
            url: "adminfunction.php",
            data: {action:"showimage5"},
            success: function(results){
               var div = document.getElementById('5');
               div.innerHTML = results;
         
            } 
            
        });
}

function check(){
  alert("Click on this block to edit image and link!!");
}
function testing(id){
   $.ajax({
            type: "POST",
            url: "EditInfo.php",
            data: {action:"editid",id:id},
            success:function(results){
              location.href = "EditInfo.php?id="+id;
            }           
        });
}
</script>

<body onload  = "loadImages1();">
    <?php include '../index.php' ?>
    <div class="container">	
        <div>
	       <ul class="anavul">
                <li class="anavli" >
                    <a href="#">Admin Panel</a>
                </li>
               <li>
                    <a href="index.php">Users</a>
                </li>
                                
                
<li class="dropdown"><a href="slider.php">Slider Images</a>
  <div class="dropdown-content">
    <a href="addImgSlider.php">Add Image</a>
    <a href="sliderSettings.php">Settings</a>
  </div>
               </li>
                <li >
                    <a class="active" href="admin.php">Grid Images</a>
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
    <h1 align="center">Click on the Grid Imgae to change the Url and also Picture</h1>
    
<div class="grid">
<div style="float:left;">
  <div onclick ="return testing(1);" id = '1' class="grid-item grid-item-1" style = "padding: 5px 5px 5px 5px;"></div>
  <div onclick ="return testing(2);" id = '2' class="grid-item grid-item--w2 grid-item--h2" style = "padding: 5px 5px 5px 5px;"></div>
  <div onclick ="return testing(3);" id = '3' class="grid-item grid-item--h3" style = "padding: 5px 5px 5px 5px;"></div>
  
  <div  onclick ="return testing(4);" id ='4' class="grid-item grid-item--w3" style = "padding: 5px 5px 5px 5px;"></div>
  <div  onclick ="return testing(5);"  id = '5' class="grid-item grid-item-2" style = "padding: 5px 5px 5px 5px;"></div>
  
</div>
</div>




</body>
</html>