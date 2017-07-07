
<!DOCTYPE html>
<html>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main {
    transition: margin-left .5s;
    padding: 16px;
}
    .navi{
        position: absolute;
    top: 0px;
    left: 0px;
        height: 67px;
        width: 67px;
        display: block;
        text-align: center;
        padding-top: 20px;
    
    padding-bottom: 20px;
    padding-left: 5px;
    }

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="material-icons" style="font-size:48px;color:red">fullscreen_exit</i></a>
  <?php echo getNav(); ?>
</div>

<div id="main">
  <span class="navi" style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="material-icons" style="font-size:48px;color:black">fullscreen</i></span>
</div>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
</script>
     
</body>
</html> 

<?php 
function getNav(){
    include 'dbconnect.php';
    $sql = 'SELECT * FROM `navtable` ';
        $result = $dbLink->query($sql);
        if($result->num_rows==0){
            echo '<a href="#">No Navigation</a>';
        }else{
            $i=0;
            while($row = $result->fetch_assoc()) {
                $name=ucfirst($row['navName']);
                echo '<a href="'.$row['navUrl'].'">'.$name.'</a> ';
            }
        }
    
}

?>
