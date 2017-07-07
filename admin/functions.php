<?php 
require_once '../dbconnect.php';
ob_start();
session_start();

if(isset($_POST['func']) && !empty($_POST['func'])){
	switch($_POST['func']){
		case 'editUser':
			editUser($_POST['userId'],$_POST['userPass'],$_POST['userType']);
			break;
        case 'editSettings':
			editSettings($_POST['width'],$_POST['height'],$_POST['timer']);
			break;
        case 'addNav':
			addNav($_POST['navName'],$_POST['navUrl']);
			break;
        case 'delUser':
            delUser($_POST['userId']);
            break;
        case 'delSlider':
            delSlider($_POST['userId']);
            break;
        case 'delGrid':
            delGrid($_POST['userId']);
            break;
        case 'delNav':
            delNav($_POST['userId']);
            break;
        default:
			break;
	}
}

function delUser($id){
    include '../dbconnect.php';
    
   $result = $dbLink->query("Delete FROM eusers where userId=".$id.";");
   
    if($result){
		echo 'ok';
	}else{
		echo mysqli_error();
	}
    
}

function delSlider($id){
    include '../dbconnect.php';
    
   $result = $dbLink->query("Delete FROM sliderimg where imgId=".$id.";");
   
    if($result){
		echo 'ok';
	}else{
		echo mysqli_error();
	}
    
}

function delGrid($id){
    include '../dbconnect.php';
    
   $result = $dbLink->query("Delete FROM gridimg where imgId=".$id.";");
   
    if($result){
		echo 'ok';
	}else{
		echo mysqli_error();
	}
    
}

function delNav($id){
    include '../dbconnect.php';
    
   $result = $dbLink->query("Delete FROM navtable where id=".$id.";");
   
    if($result){
		echo 'ok';
	}else{
		echo mysqli_error();
	}
    
}

function editUser($userId,$userPass,$userType){
    include '../dbconnect.php';
    if($userPass!=""){
        $userPass = hash('sha256', $userPass);
        $sql = 'Update eusers set userPass="'.$userPass.'",userType="'.$userType.'" where userId='.$userId;
    }else{
        $sql = 'Update eusers set userType="'.$userType.'" where userId='.$userId;
    }
    
    
    $result = $dbLink->query($sql);
    if($result){
        echo "ok";
    }else{
        echo mysqli_error();
    }
}

function editSettings($width,$height,$timer){
    include '../dbconnect.php';
    $res=$dbLink->query("SELECT * FROM slidersettings");

    if($res->num_rows == 0) {
        $sql="INSERT INTO `slidersettings` (`width`, `height`,`timer`) VALUES ({$width},{$height},{$timer})";
        
    }else{
       
        $sql = 'Update slidersettings set width='.$width.', height='.$height.', timer='.$timer.' where id=1';
    }
        
    $result = $dbLink->query($sql);
    if($result){
        echo "ok";
    }else{
        echo mysqli_error();
    }
}


function getUsers(){
include '../dbconnect.php';
// Query for a list of all existing files
$sql = 'SELECT * FROM `eusers` ';
$result = $dbLink->query($sql);
echo '<h1 align=center>List of all the users</h1>';
// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no Users</p>';
    }
    else {
        // Print the top of a table
        echo '<table width="100%">
                <tr>
                    <td><b>User ID</b></td>
                    <td><b>User Name</b></td>
                    <td><b>User Email</b></td>
                    <td><b>User Type</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';

        // Print each file
        while($row = $result->fetch_assoc()) {
            $name=strtoupper($row['userName']);
            
            echo '
                <tr>
                    <td>'.$row['userId'].'</td>
                    <td>'.$name.'</a></td>
                    <td>'.$row['userEmail'].'</td>
                    <td>'.$row['userType'].'</td>
                    <td><a class="button" href="profile.php?userId='.$row['userId'].'">View/Update<a></td>
                    <td><a class="button" href="javascript:void(0)" onclick="deleteUser('.$row['userId'].');">Delete</a></td>
                </tr>';
        }

        // Close table
        echo '</table>';
    }

    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}

}

function getSliderImgs(){
include '../dbconnect.php';
// Query for a list of all existing files
$sql = 'SELECT * FROM `sliderimg` ';
$result = $dbLink->query($sql);
    
    echo '<h1 align="center">Here the User can delete the images  from slider or Add the images to slider</h1>';

// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no Users</p>';
    }
    else {
        // Print the top of a table
        echo '<table width="100%">
            <thead>
                <tr>
                    <th>Image_ID</th>
                    <th><b>Image_Name</b></th>
                    <th><b>Image_File</b></th>
                    <th><b>&nbsp;</b></th>
                    <th><a class="button" href="addImgSlider.php">Add</a></th>
                </tr>
                </thead>';

        // Print each file
        echo '<tbody>';
        while($row = $result->fetch_assoc()) {
            $name=strtoupper($row['imgName']);
            echo '
                <tr>
                    <td>'.$row['imgId'].'</td>
                    <td>'.$name.'</td>
                    <td><img  style="width:30%" src="data:image/png;base64,'.base64_encode($row['imgFile']).'" alt="Product"></td>
                    
                   
                   
                    <td><a class="button" href="javascript:void(0)" onclick="deleteImg('.$row['imgId'].');">Delete</a></td>
                </tr>';
        }
        echo '</tbody>';
        // Close table
        echo '</table>';
    }

    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}

}

function getGridImgs(){
include '../dbconnect.php';
// Query for a list of all existing files
$sql = 'SELECT * FROM `gridimg` ';
$result = $dbLink->query($sql);

// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no Users</p>';
    }
    else {
        // Print the top of a table
        echo '<table width="100%">
            <thead>
                <tr>
                    <th>Image_ID</th>
                    <th><b>Image_Name</b></th>
                    <th><b>Image_File</b></th>
                    <th><b>&nbsp;</b></th>
                </tr>
                </thead>';

        // Print each file
        echo '<tbody>';
        while($row = $result->fetch_assoc()) {
            $name=strtoupper($row['imgName']);
            echo '
                <tr>
                    <td>'.$row['imgId'].'</td>
                    <td>'.$name.'</td>
                    <td><img  style="width:30%" src="data:image/png;base64,'.base64_encode($row['imgFile']).'" alt="Product"></td>
                   
                    <td><a class="button" href="javascript:void(0)" onclick="deleteImg('.$row['imgId'].');">Delete</a></td>
                </tr>';
        }
        echo '</tbody>';
        // Close table
        echo '</table>';
    }

    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}

}

function getNavs(){
    include '../dbconnect.php';
echo '<h1 align="center">Add the New Url to the side Nav bar here!!</h1>';
    echo '<table width="100%">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th><b>Display Name</b></th>
                    <th><b>Url</b></th>
                    <th><b>&nbsp;</b></th>
                </tr>
                </thead>';

        // Print each file
        echo '<tbody>';
        echo '<tr>
                <td>url</td>
                <td><input type="text" id="navName" placeholder="label" /> </td>
                <td><input type="url" id="navUrl" placeholder="enter the url to link" /> </td>
                <td><input class="button" type="button" onclick="addNav()" value="Add" /> </td>
            </tr>';
    echo '</tbody>';
        
        echo '</table>';
    echo '<h1 align="center">Existing labels and Links</h1>';
    echo '<table width=100%>';
        // Close table
        echo '<tbody>';
        $sql = 'SELECT * FROM `navtable` ';
        $result = $dbLink->query($sql);
        if($result->num_rows==0){
            echo '<tr><td colspan="4">No Navigations</td></tr>';
        }else{
            $i=1;
            while($row = $result->fetch_assoc()) {
                $name=ucfirst($row['navName']);
                echo '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$name.'</td>
                        <td><a class="button" href="'.$row['navUrl'].'" target="_blank">View</a></td>

                        <td><a class="button" href="javascript:void(0)" onclick="deleteNav('.$row['id'].');">Delete</a></td>
                    </tr>';
                $i=$i+1;
            }
        }
        
        echo '</tbody>';
        // Close table
        echo '</table>';
}

function addNav($navName,$navUrl){
    include '../dbconnect.php';
    
    $sql='INSERT INTO `navtable` (`navName`, `navUrl`) VALUES ("'.$navName.'","'.$navUrl.'")';
    
    $result = $dbLink->query($sql);
    if($result){
        echo "ok";
    }else{
        echo mysqli_error();
    }
}







?>