<?php
require_once '../dbconnect.php';
ob_start();
session_start();

if(isset($_POST['func']) && !empty($_POST['func'])){
	switch($_POST['func']){
		case 'login':
			login($_POST['username'],$_POST['password']);
			break;
        case 'register':
            register($_POST['username'],$_POST['email'],$_POST['password']);
            break;
            case 'editUser':
editUser($_POST['userId'],$_POST['userPass']);
            break;
		default:
			break;
	}
}

function editUser($userId,$userPass)
{
	
	  include '../dbconnect.php';
     $password = hash('sha256', $userPass); 
	$query="update eusers set userPass='".$password."' WHERE userId='".$userId."'";
		
		$res=mysql_query($query);
		if($res)
		{
		echo 'alert("password changed")';
		}
		else
		{
			echo 'dummy';
		}
	
}
function login($email,$pass){
    include '../dbconnect.php';
    
    $error = false;
    $email = trim($email);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($pass);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    
    
    
    if(empty($email)){
        $error = true;
        $emailError = "Please enter your email address.";
        echo $emailError;
        exit;
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address.";
        echo $emailError;
        exit;
    }

    if(empty($pass)){
        $error = true;
        $passError = "Please enter your password.";
        echo $passError;
        exit;
    }
    
    
    if (!$error) {
        
        $password = hash('sha256', $pass); 

        $res=$dbLink->query("SELECT userId, userName, userPass,userType FROM eusers WHERE userEmail='$email'");
        $row=mysqli_fetch_assoc($res);
        $count = $res->num_rows; 
        
        if( $count == 1 && $row['userPass']==$password ) {
            $_SESSION['user'] = $row['userId'];
            $_SESSION['userType'] = $row['userType'];
            echo $_SESSION['userType'];
            
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
            echo $errMSG;
            exit;
        }

    }
    
}

function register($username,$email,$password){
    include '../dbconnect.php';
    
    $error = false;
    // clean user inputs to prevent sql injections
    $name = trim($username);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    $email = trim($email);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($password);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    
    
    // basic name validation
    if (empty($name)) {
        $error = true;
        $nameError = "Please enter your full name.";
        echo $nameError;
        exit;
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have atleat 3 characters.";
        echo $nameError;
        exit;
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $nameError = "Name must contain alphabets and space.";
        echo $nameError;
        exit;
    }

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address.";
        echo $emailError;
        exit;
    } else {
        // check email exist or not
        $query = "SELECT userEmail FROM eusers WHERE userEmail='$email'";
        $result = $dbLink->query($query);
        $count = $result->num_rows;
        if($count!=0){
            $error = true;
            $emailError = "Provided Email is already in use.";
            echo $emailError;
        exit;
        }
    }
    // password validation
    if (empty($pass)){
        $error = true;
        $passError = "Please enter password.";
        echo $passError;
        exit;
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters.";
        echo $passError;
        exit;
    }

    // password encrypt using SHA256();
    $password = hash('sha256', $pass);

    // if there's no error, continue to signup
    if( !$error ) {

        $query = "INSERT INTO eusers(userName,userEmail,userPass) VALUES('$name','$email','$password')";
        $res = $dbLink->query($query);
        
        if ($res) {
            // the message
            $msg = "Hello ".$name.",\nYou Have Successfully registered to Katuri's web page ,\n please click on the following link to login back";
           

            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);
            $headers .= "From: Venkata Surya Sandeep Katuri <kvssandeep93@gmail.com>";
            // send email
            $m= mail($email,"Katuri's-Login",$msg,$headers);
            echo "ok";
            
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            echo $errMSG;
        exit;
        }

    }

}


?>