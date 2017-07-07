<?php
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
	
	// select loggedin users detail
	
?>
<?php


// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
        $dbLink = new mysqli('localhost', 'root', '', 'test');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }

        // Gather all required data
    if ($_SERVER['REQUEST_METHOD'] =='POST') { 
        $imagename = mysqli_real_escape_string($dbLink,$_POST['imagename']);
        $imgSize = $_POST['imgSize'];
    
        $image = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        // Create the SQL query
    }
        $query = "
            INSERT INTO `sliderimg` (
                `imgName`, `imgFile`,`imgSize`
            )
            VALUES (
                '{$imagename}',  '{$image}', '{$imgSize}'
            )";

        // Execute the query
        $result = $dbLink->query($query);

        // Check if it was successfull
        if($result) {
            header("Location:slider.php");
        }else {
            echo 'Error! Failed to insert the file'
            . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'ERROR!Select a File to upload!';
    }

    
}
else {
    echo 'Error! A file was not sent!';
}

// Echo a link back to the main page
echo '<p>Click <a href="index.php">here</a> to go back to Index screen</p>';
?>

