<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

session_start();
require 'ac-config.php';

$logout = "";

if (isset($_GET["action"])) {
	
	$url = $_GET["action"];
	
	if($url == "login") { 
	
		$ac_login_username = $_POST["username"];
		$ac_login_password = $_POST["password"];	
	
	}elseif ($url == "logout") {
		
		session_destroy();
		$logout = '  <div class="ac-login-information">
                     <h6>Log Out Successfully</h6>
                     </div> ';

	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AdminConsole CORE Login</title>
	<meta name="robots" content="noindex">
    <link rel="icon" type="image/png" sizes="16x16" href="admin/img/favicon16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="admin/img/favicon32.png">
    <link rel="icon" type="image/png" sizes="180x180" href="admin/img/favicon180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="admin/img/favicon192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="admin/img/favicon512.png">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/css/FontAwesome/fontawesome-all.min.css">
	<link rel="stylesheet" href="admin/css/FontAwesome/font-awesome.min.css">
    <link rel="stylesheet" href="admin/css/ac-login.css">	
</head>

<body>
    <div id="ac-login">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ac-login-div">
                        <div class="ac-login-content">
                            <div class="text-center"><img src="admin/img/ac1.png"></div>
							
							<?php  
							
							if (isset($_GET["action"])) {
	
								$url = $_GET["action"];
								
								if ($url == "login") {
								
									if (isset($ac_login_username)) {
								
										if ($ac_login_username == $ac_username){  
								
										if ($ac_login_password == $ac_password) {
									 
											$_SESSION["username"] = "Admin";
											
											header("Location: admin/index.php");
									
										}else {
									
											echo '  <div class="ac-login-information">
                                					<h6>Invalid Login Information</h6>
                            						</div> ';	
									
										}
								
										}else {
								
											echo '  <div class="ac-login-information">
                                					<h6>Invalid Login Information</h6>
                            						</div> ';	
								
										}								
									}
								}	
							}
							echo $logout;
							?>
                           
                            <div class="ac-login-form">
                                <form method="post" action="ac-login.php?action=login">
                                    <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username or E-mail Address"></div>
                                    <div class="form-group"><input class="form-control" type="password" name="password" autocomplete="off" placeholder="Password"></div>
                                    <div class="form-group"><button class="btn btn-primary" type="submit">Log&nbsp;In</button></div>
                                </form>
                            </div>
                            <div class="ac-login-additional"><a href="index.php"><i class="fas fa-long-arrow-alt-left"></i>&nbsp;Back to site</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
</body>
</html>