<?php
error_reporting(0);
include("SQLConnect.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$link = $_POST['link'];

$imgId = $_GET['pid'];

$image = mysql_real_escape_string(file_get_contents($_FILES['uploaded_file']['tmp_name']));
$sql2 = "delete from grid_images where id = $imgId";
if(mysql_query($sql2)){
	
    

}else{
	
}

$sql = "insert into grid_images (id,Images,link) values ($imgId,'$image','$link') ";


if(mysql_query($sql)){
	
    echo "<script type='text/javascript'> window.location= 'admin.php';</script>";
    

}else{
	
}
}


 ?>
