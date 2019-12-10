<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

session_start();
require "../ac-config.php";
if (empty($_SESSION["AC-ADMIN-USERNAME"])) {
	
	header("Location: ../ac-login.php");
	
	}

$sql_settings = "SELECT value FROM ".$table_prefix."settings WHERE ID='5'";
$result_settings = $conn->query($sql_settings);

if ($result_settings->num_rows > 0){
	while($row_settings = $result_settings->fetch_assoc()) {
		date_default_timezone_set($row_settings["value"]);
	}
}

if (isset($_GET["action"])){
	
	switch ($_GET["action"]) {
				
			case "upload":
			
				$folders = date("Y").'/'.date("m").'/';
				if(!is_dir('../uploads/images/'.date('Y'))){	
					mkdir('../uploads/images/'.date('Y'));	
					if(!is_dir('../uploads/images/'.date('Y').'/'.date('m'))){
						mkdir('../uploads/images/'.date('Y').'/'.date('m'));	
					}				
				}else {	
					if(!is_dir('../uploads/images/'.date('Y').'/'.date('m'))){	
						mkdir('../uploads/images/'.date('Y').'/'.date('m'));	
					}	
				}
				$target_dir = "uploads/images/".$folders;
				$target_file = $target_dir . basename($_FILES["file"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$check = getimagesize($_FILES["file"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				}else {
					$uploadOk = 0;
				}
				if (file_exists("../".$target_file)) {
    			$uploadOk = 0;
				}
				if ($uploadOk == 0) {
				} else {
					if (move_uploaded_file($_FILES["file"]["tmp_name"], '../'.$target_file)) {
						$image_date = date("Y-m-d H:i");
						$image_date_gmt = gmdate("Y-m-d H:i");	
						$image_name = $_FILES["file"]["name"];
						$image_size = $_FILES["file"]["size"];
						$image_location = $target_file;
						$image_mine = mime_content_type('../'.$target_file);
						
						$sql = "INSERT INTO ".$table_prefix."images (image_date, image_date_gmt, image_name, image_alt, image_size, image_location, image_mime) VALUES ('$image_date', '$image_date_gmt', '$image_name', '', '$image_size', '$image_location', '$image_mine')";
						
						if ($conn->query($sql) === TRUE){
							
						}
					}
				}
				
				break;	
			
			case "update":
			
				break;
			
			case "delete":
					
				if (isset($_GET["id"])){
					
					$sql = "SELECT * FROM ".$table_prefix."images WHERE ID=".$_GET["id"]."";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){
    					while($row = $result->fetch_assoc()) {
        					
							$location = $row["image_location"];
							unlink("../".$location);
							
							$sql = "DELETE FROM ".$table_prefix."images WHERE ID=".$_GET["id"]."";

							if ($conn->query($sql) === TRUE) {
								
								echo "Image is successfully deleted!";
							}							
    					}
					}					
				}
				exit;
				break;

		}
	
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
	<link rel="stylesheet" href="js/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css">
	<script src="js/jquery.js"></script>
</head>

<body>
    <?php
	require "includes/interface/ac-navbar.php";
	require "includes/interface/ac-sidebar.php";
	include "includes/functions.php";
	?>
    
    <div id="ac-content">
		<div>
			<h3>New images</h1>
		</div>	
		<div id="uploader">
		<p>Your browser doesn't have HTML5 support.</p>
	</div>
    </div>
<script>
$(function() {
	

	$("#uploader").pluploadQueue({

		runtimes : 'html5,html4',
		url : 'media-new.php?action=upload',
		rename : true,
		dragdrop: true,
		multiple_queues: true,
		
		filters : {

			max_file_size : '<?php MAX_UPLOAD_SIZE();?>mb',

			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png,jpeg"},
			]
		},
	});

});
</script>
    <script src="js/bootstrap.js"></script>
    <script src="js/ac-scripts.js"></script>
	<script src="js/plupload/js/plupload.full.min.js"></script>
	<script src="js/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
</body>
</html>