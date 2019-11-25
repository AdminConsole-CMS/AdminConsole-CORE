<?php

/*
 * adminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

require 'ac-config.php';

if (isset($_GET["action"])){
	
	if ($_GET["action"] == "login"){
	
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			
			if(isset($_REQUEST['username'])){
				
				$login_username = $_REQUEST['username'];
				
			}		
				
			if (isset($_REQUEST['password'])){
				
				$login_password = $_REQUEST['password'];
				
			}
			
			if (isset($_REQUEST['remember'])){
				
				$login_remember = $_REQUEST['remember'];
				
				if ($login_remember == TRUE){
					
					setcookie("username", $login_username, time() + (86400), "/");
					
				}				
			}else {
				
				setcookie("username", "", time() - (86400 * 30), "/");
				
			}		
		
    		if (!empty($login_username)){						
				
				if (!empty($login_password)){
					
					if (strtolower($ac_username) == strtolower($login_username)) {
						
						if ($ac_password == $login_password) {
							
							session_start();
							$_SESSION["AC-ADMIN-USERNAME"] = $ac_username;							
							echo 'success';
							exit;
							
						}else {
							
							echo '<h5 class="red">Invalid Log In informations</h5>';
							exit;
							
						}
						
					}else {
						
						echo '<h5 class="red">Invalid Log In informations</h5>';
						exit;
						
					}						
				}else {
					
					echo '<h5 class="red">Invalid Log In informations</h5>';
					exit;
					
				}				
    		}else {
				echo '<h5 class="red">Invalid Log In informations</h5>';
				exit;
		
    		}	
		}
		
	}elseif ($_GET["action"] == "logout"){
		
		session_start();
		session_destroy();
		header("Location: ac-login.php");
		
	}			
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AC Login</title>
	<meta name="robots" content="noindex">
    <link rel="icon" href="admin/img/favicon.ico">
    <link rel="stylesheet" href="admin/css/ac-bootstrap.css">
    <link rel="stylesheet" href="admin/css/ac-login.css">	
</head>

<body>
 <div id="ac-login" class="light">
    <div class="ac-login-form">
        <div class="ac-login-form-div">
            <div>
                <div class="text-center"><img src="admin/img/ac.png"></div>
                <div class="ac-login-info">
                    
                </div>
                <form id="ac-login-form">
                    <div class="form-group back"><input type="text" class="form-control2" name="username" value="<?php if(isset($_COOKIE["username"])){ echo $_COOKIE["username"]; } ?>" placeholder="Username / E-mail address"></div>
                    <div class="form-group back"><input type="password" class="form-control2" name="password" placeholder="Password"></div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="remember" name="remember" value="TRUE"><label class="custom-control-label" for="remember">Remember me</label></div>
                    </div>
                    <div class="form-group"><button class="btn btn-primary" type="submit">Log In</button></div>
                </form>
                <div class="ac-login-add"><a href="index.php">«&nbsp;Back&nbsp;to&nbsp;site</a></div>
            </div>
        </div>
    </div>
</div>
<script src="admin/js/jquery.js"></script>
<script src="admin/js/bootstrap.js"></script>
<script>
$(function () {
	
	$('#ac-login-form').on('submit', function (e) {
		
		e.preventDefault();
		
		$.ajax({
			type: 'post',
			url: 'ac-login.php?action=login',
			data: $(this).serialize(),
			success: function (data) {
				
				if (data == "success"){
					window.location = "admin/index.php";
				}else {					
					$('.ac-login-info').html(data);
				}
			}
		});
		
	});
	
});	
</script>	
</body>
</html>