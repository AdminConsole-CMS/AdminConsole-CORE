<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

session_start();
require "../ac-config.php";

if (empty($_SESSION['username'])) {
	
	header("Location: ../ac-login.php");
	
	}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AdminConsole CORE</title>
	<meta name="robots" content="noindex">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon32.png">
    <link rel="icon" type="image/png" sizes="180x180" href="img/favicon180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/favicon192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="img/favicon512.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/FontAwesome/fontawesome-all.min.css">
	<link rel="stylesheet" href="css/FontAwesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/blocks/content.css">
    <link rel="stylesheet" href="css/blocks/navbar.css">
    <link rel="stylesheet" href="css/blocks/sidebar.css">
</head>

<body>
    <?php
	require "includes/admin-navbar.php";
	require "includes/admin-sidebar.php";
	?>
    
    <div id="ac-content">
		<h1 class="text-center">Welcome back!</h1>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ac-fullscreen.js"></script>
    <script src="js/ac-sidebar-collapse.js"></script>
</body>

</html>