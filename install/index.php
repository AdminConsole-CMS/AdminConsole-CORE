<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

require 'includes/class-installer.php';
session_start();	

	$AC_Installer = new AC_Installer();	
	$AC_Installer -> checker();
	$AC_Installer -> random_prefix();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AdminConsole CORE Installation</title>
	<meta name="robots" content="noindex">
    <link rel="icon" href="includes/img/favicon.ico">
    <link rel="stylesheet" href="includes/css/ac-bootstrap.css">
    <link rel="stylesheet" href="includes/css/installation.css">
	<script type="text/javascript" src="includes/js/jquery.js"></script>
</head>

<body>
 <div id="ac-installation">
    <div class="ac-installation">
        <div class="ac-installation-div">
            <div>
                <div class="text-center"><img src="includes/img/ac.svg"></div>
				<?php 
				
				echo $AC_Installer -> alert();
				echo $AC_Installer -> view();

				?>				
            </div>
        </div>
    </div>
</div>	
</body>
</html>