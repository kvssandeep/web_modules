<?php 

function getImages(){
    include '../dbconnect.php';
    $sql = 'SELECT * FROM `sliderimg` ';
    $result = $dbLink->query($sql);
    
    if($result->num_rows == 0) {
        echo '<p>There are no Users</p>';
    }else{
        while($row = $result->fetch_assoc()){
            echo '<img class="mySlides" src="data:image/png;base64,'.base64_encode($row['imgFile']).'" alt="Product" style="width:'.$row['imgSize'].'">';
        }
       
    }
}

function getButtons(){
    include '../dbconnect.php';
    $sql = 'SELECT * FROM `sliderimg` ';
    $result = $dbLink->query($sql);
    $count = $result->num_rows;
    $i=1;
    while($i<=$count){
        echo '<button class="btn demo" onclick="currentDiv('.$i.')">'.$i.'</button> ';
        $i=$i+1;
    } 
}

function getImage(){
    include '../dbconnect.php';
    $sql = 'SELECT * FROM `sliderimg` ';
    $result = $dbLink->query($sql);
    
    if($result->num_rows == 0) {
        echo '<p>There are no images uploaded yet for slider</p>';
    }else{
        while($row = $result->fetch_assoc()){
            echo '<img class="mySlides  w3-animate-fading" src="data:image/png;base64,'.base64_encode($row['imgFile']).'" alt="Product"  style="width:'.$row['imgSize'].'">';
            
        }
       
    }
}

function getTimer(){
    include '../dbconnect.php';
    echo "4000";
}


?>