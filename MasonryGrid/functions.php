<?php
error_reporting(0);

 if($_POST['action'] == 'updateGrid'){

 	   $id = $_POST['id'];
 	   update($id);
 }

  if($_POST['action'] == "showimage1"){
 	   
 	   showImage1(1);
 }

 if($_POST['action'] == "showimage2"){
 	   
 	   showImage2(2);
 }

  if($_POST['action'] == "showimage3"){
 	   
 	   showImage3(3);
 }

  if($_POST['action'] == "showimage4"){
 	   
 	   showImage4(4);
 }

  if($_POST['action'] == "showimage5"){
 	   
 	   showImage5(5);
 }
 function showImage1($id){

 	 include("SQLConnect.php");
    
    	$query = "select Images,link from grid_images where id = $id";

    	$que = mysql_query($query);
    	$total = 0;
    	 $rows = mysql_num_rows($que);
    	 if($rows >0){
    	 	while($row = mysql_fetch_array($que)){
    	 		$link = $row['link'];
    	 		 echo '<a href= '.$link.' ><img src="data:image/jpeg;base64,'.base64_encode( $row['Images'] ).'" height= "460" width = "500"/></a>';
    	 	}
    	 }
 }

 function showImage2($id){

 	 include("SQLConnect.php");

    	$query = "select Images,link from grid_images where id = $id";
    	$que = mysql_query($query);
    	$total = 0;
    	 $rows = mysql_num_rows($que);
    	 if($rows >0){
    	 	while($row = mysql_fetch_array($que)){
    	 		$link = $row['link'];
    	 		 echo '<a href= '.$link.' ><img src="data:image/jpeg;base64,'.base64_encode( $row['Images'] ).'" height= "460" width = "500"/>';
    	 	}
    	 }
 }

function showImage3($id){

 	 include("SQLConnect.php");
    	
    	$query = "select Images,link from grid_images where id = $id";
    	$que = mysql_query($query);
    	$total = 0;
    	 $rows = mysql_num_rows($que);
    	 if($rows >0){
    	 	while($row = mysql_fetch_array($que)){
    	 		$link = $row['link'];
    	 		 echo '<a href= '.$link.' ><img src="data:image/jpeg;base64,'.base64_encode( $row['Images'] ).'" height= "460" width = "360"/>';
    	 	}
    	 }
 }
function showImage4($id){

 	 include("SQLConnect.php");
    	
    	$query = "select Images,link from grid_images where id = $id";
    	$que = mysql_query($query);
    	$total = 0;
    	 $rows = mysql_num_rows($que);
    	 if($rows >0){
    	 	while($row = mysql_fetch_array($que)){
    	 		$link = $row['link'];
    	 		 echo '<a href= '.$link.' ><img src="data:image/jpeg;base64,'.base64_encode( $row['Images'] ).'"  height= "300" width = "400"/>';
    	 	}
    	 }
 }
function showImage5($id){

 	 include("SQLConnect.php");
    	
    	$query = "select Images,link from grid_images where id = $id";
    	$que = mysql_query($query);
    	$total = 0;
    	 $rows = mysql_num_rows($que);
    	 if($rows >0){
    	 	while($row = mysql_fetch_array($que)){
    	 		$link = $row['link'];
    	 		 echo '<a href= '.$link.' ><img src="data:image/jpeg;base64,'.base64_encode( $row['Images'] ).'" height= "350" width = "460"/>';
    	 	}
    	 }
 }

?>