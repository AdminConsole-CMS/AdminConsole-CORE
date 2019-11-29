<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

session_start();
require "../ac-config.php";
if (empty($_SESSION["AC-ADMIN-USERNAME"])) {
	
	header("Location: ../ac-login.php");
	
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AdminConsole CORE</title>
	<link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/ac-bootstrap.css">
    <link rel="stylesheet" href="fonts/FontAwesome/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
	require "includes/interface/ac-navbar.php";
	require "includes/interface/ac-sidebar.php";	
	?>
    
    <div id="ac-content">
		<h1 class="text-center">Welcome back!</h1>
		<button class="btn btn-primary" type="button">Button</button><button class="btn btn-danger" type="button">Button</button><button class="btn btn-warning" type="button">Button</button><button class="btn btn-success" type="button">Button</button>
        <form><input class="form-control2" type="text"></form>
        <p>Paragraph</p>
		<div class="ac-alert">
			<p>test</p>
		</div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/ac-scripts.js"></script>
</body>
</html>
