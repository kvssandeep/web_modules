<?php
ob_start();
session_start();
require_once '../dbconnect.php';


if ( isset($_SESSION['user'])!="" ) {
    header("Location: profile.php");
    exit;
}
?>
<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
   
    <title>Test2</title>
    
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/style3.css" />
    <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    <script src="../jquery-1.11.3-jquery.min.js"></script>
</head>
<body>
    <div class="container">
        

        <section>
            <div id="container_demo">
                
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form >
                            <h1>Log in</h1>
                            

                            <p>
                                <label for="username" class="uname" data-icon="u">Your email or username </label>
                                <input id="email" name="email" required="required" type="email" placeholder="myusername or mymail@mail.com" />
                                
                            </p>
                            <p>
                                <label for="password" class="youpasswd" data-icon="p">Your password </label>
                                <input id="pass" name="pass" required="required" type="password" placeholder="eg. X8df!90EO" />
                               
                            </p>

                            <p class="login button">
                                <input type="button" value="Login" name="btn-login" onclick="login();"/>
                            </p>
                            <p class="change_link">
                                Not a member yet ?
                                <a href="#toregister" class="to_register">Join us</a>
                            </p>
                        </form>
                    </div>

                    <div id="register" class="animate form">
                        <form >
                            <h1>Sign up </h1>
                            <p>
                                <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                            </p>
                            <p>
                                <label for="emailsignup" class="youmail" data-icon="e">Your email</label>
                                <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com" />
                            </p>
                            
                            <p>
                                <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO" />
                            </p>
                            
                            <p class="signin button">
                                <input type="button" value="Sign up" name="btn-signup" onclick="register();" />
                            </p>
                            <p class="change_link">
                                Already a member ?
                                <a href="#tologin" class="to_register">Go and log in </a>
                            </p>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        function login(){
            var username=$('#email').val();
            var password=$('#pass').val();
            
            
            $.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=login&username='+username+'&password='+password,
					success:function(msg){
                        
                    if(msg.includes('ADMIN')){
    				        location.href="../admin/index.php";
						}else if(msg.includes('USER')){
                            location.href="profile.php";
                        }else{
                            alert("<?php echo $_SESSION['userType']; ?>");
                            alert("<?php echo $_SESSION['user']; ?>");
							alert(msg);
						}
					}
				});
        }
        
        function register(){
            var username=$('#usernamesignup').val();
            var email=$('#emailsignup').val();
            var password=$('#passwordsignup').val();
            
            
            $.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=register&username='+username+'&email='+email+'&password='+password,
					success:function(msg){
                        
                    if(msg.includes('ok')){
    				        alert('Registered Successfully.');
                            location.href="profile.php";
						}else{
							alert(msg);
						}
					}
				});
        }
    
    
    </script>
</body>
</html>