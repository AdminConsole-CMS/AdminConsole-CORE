<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

session_start();
require "../ac-config.php";
if (empty($_SESSION["AC-ADMIN-USERNAME"])) {
	
	header("Location: login.php");
	
	}

$sql_settings = "SELECT value FROM ".$table_prefix."settings WHERE ID='5'";
$result_settings = $conn->query($sql_settings);

if ($result_settings->num_rows > 0){
	while($row_settings = $result_settings->fetch_assoc()) {
		date_default_timezone_set($row_settings["value"]);
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
			<h3>Images library <button class="btn btn-primary" id="addImages">Add new</button></h1>
		</div>
	<div id="uploader" style="display: none;">
		<p>Your browser doesn't have HTML5 support.</p>
	</div>
	<div id="image-listing">
		<div class="table-responsive table-bordered">
    		<table class="table table-striped table-bordered table-sm">
        		<thead>
           			<tr>
                		<th>ID</th>
                		<th>Image name</th>
                		<th>Image size</th>
                		<th>Image location</th>
                		<th>Image date</th>
                		<th>Image date GMT</th>
						<th>Delete</th>
            		</tr>
        		</thead>
        	<tbody>					
					<?php 
					$sql = "SELECT * FROM ".$table_prefix."images ORDER BY ID asc";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){
						
    					while($row = $result->fetch_assoc()) {
						
						$bytes = $row["image_size"];	
							
						if ($bytes >= 1073741824){
            				$bytes = number_format($bytes / 1073741824, 2) . ' GB';
        				}elseif ($bytes >= 1048576){
            				$bytes = number_format($bytes / 1048576, 2) . ' MB';
        				}elseif ($bytes >= 1024){
            				$bytes = number_format($bytes / 1024, 2) . ' KB';
        				}elseif ($bytes > 1){
            				$bytes = $bytes . ' bytes';
        				}elseif ($bytes == 1){
            				$bytes = $bytes . ' byte';
        				}else{
            				$bytes = '0 bytes';
        				}
							
						echo '<tr>';
							echo '<td>'.$row["ID"].'</td>';
							echo '<td>'.$row["image_name"].'</td>';
							echo '<td>'.$bytes.'</td>';
							echo '<td>'.$row["image_location"].'</td>';
							echo '<td>'.$row["image_date"].'</td>';
							echo '<td>'.$row["image_date_gmt"].'</td>';
							echo '<td><button class="btn btn-danger btn-sm ac-delete-image" type="button" aria-id="'.$row["ID"].'" aria-location="media-new.php?action=delete&id='.$row["ID"].'">Delete</button></td>';
						echo '</tr>';	
							
    					}
					} else {
						echo '<tr>';
    						echo '<td colspan="7" class="text-center">No images uploaded!</td>';
						echo '</tr>';
					}
					
					?>
        	</tbody>
    	</table>
	</div>	
	</div>	
    </div>
<script type="text/javascript">
	
$(function () {
	
	$('#addImages').on('click', function (e) {
		
		$("#uploader").toggle();
		
	});	
});
	
$(function() {
	

	$("#uploader").pluploadQueue({

		runtimes : 'html5,html4',
		url : 'media-new.php?action=upload',
		rename : true,
		dragdrop: true,
		multiple_queues: true,
		prevent_duplicates: true,
		
		filters : {
			
			
			max_file_size : '<?php MAX_UPLOAD_SIZE();?>mb',

			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png,jpeg"},
			]
		},
	});

});
</script>
<script>
$(function () {
	
	$('.ac-delete-image').on('click', function (e) {
		
		e.preventDefault();
		var image = $(this).attr('aria-id');
		var image_location = $(this).attr('aria-location');
		var conf = confirm("Are you sure?");
		if (conf == true){
			$.ajax({
				type: 'post',
				url: image_location,
				data: $(this).serialize(),
				success: function (data) {
				
					if (data == "Image is successfully deleted!"){
						alert(data);
						location.reload(true);
					}
				}
			});
		}				
	});	
});	
</script>		
    <script src="js/bootstrap.js"></script>
    <script src="js/ac-scripts.js"></script>
	<script src="js/plupload/js/plupload.full.min.js"></script>
	<script src="js/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
</body>
</html>