<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

require '../ac-config.php';
require "includes/class-login.php";
$AC_Login = new AC_Login;
$AC_Login -> checker();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AC Login</title>
    <link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/ac-bootstrap.css">
    <link rel="stylesheet" href="css/ac-login.css">	
</head>

<body>
 <div id="ac-login" class="light">
    <div class="ac-login-form">
        <div class="ac-login-form-div">
            <div>
                <div class="text-center"><img src="img/ac.png"></div>
                <div class="ac-login-info">
                 <?php echo $AC_Login -> alert(); ?>   
                </div>
                <form id="ac-login-form" action="login.php?action=login" method="post">
                    <div class="form-group back"><input type="text" class="form-control2" name="username" value="<?php if(isset($_COOKIE["username"])){ echo $_COOKIE["username"]; } ?>" placeholder="Username / E-mail address"></div>
                    <div class="form-group back"><input type="password" class="form-control2" name="password" placeholder="Password"></div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="remember" name="remember" value="TRUE"><label class="custom-control-label" for="remember">Remember me</label></div>
                    </div>
                    <div class="form-group"><button class="btn btn-primary" type="submit">Log In</button></div>
                </form>
                <div class="ac-login-add"><a href="../index.php">«&nbsp;Back&nbsp;to&nbsp;site</a></div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
 <script>
$(function () {
	
	$('#ac-login-form').on('submit', function (e) {
		
		e.preventDefault();
		
		$.ajax({
			type: 'post',
			url: 'login.php?action=login',
			data: $(this).serialize(),
			success: function (data) {
				
				if (data == "success"){
					window.location = "index.php";
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
