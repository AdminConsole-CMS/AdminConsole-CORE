<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

session_start();
require "../ac-config.php";
include "includes/functions.php";
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

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if (isset($_GET["action"])){
		
		if ($_GET["action"] == "new"){
			
			if (isset($_POST["title"])){
				$article_title = $_POST["title"];
				$article_name_acc = ACCENTS($article_title);
				$article_name_low = strtolower($article_name_acc);
				$article_name = str_replace(" ", "-", $article_name_low);
			}
			if (isset($_POST["content"])){
				$article_content = $_POST["content"];
			}
			if (isset($_POST["parent"])){
				$article_parent = $_POST["parent"];
			}
			if($article_parent == 0){
				$article_type = "a";
			}else {
				$article_type = "i";
			}
			$article_date = date("Y-m-d H:i");
			$article_date_gmt = gmdate("Y-m-d H:i");	
			$sql = "INSERT INTO ".$table_prefix."articles (article_date, article_date_gmt, article_title, article_name, article_content, article_type, article_parent) VALUES ('$article_date', '$article_date_gmt', '$article_title', '$article_name', '$article_content', '$article_type', '$article_parent')";

			if ($conn->query($sql) === TRUE) {
    			$ac_alert = "Page was succesfully added!";
			} else {
    			echo $ac_alert = "<strong>Error:</strong> " . $sql. "<br>" . $conn->error;
			}
		}
		
		}else {
		
		$ac_alert = "<strong>Error:</strong> Action is not set! Cannot add new page.";
		
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
	<link rel="stylesheet" href="css/editor.css">
	<script src="js/jquery.js"></script>
	<script src="js/tinymce/jquery.tinymce.min.js"></script>
	<script src="js/tinymce/tinymce.min.js"></script>
	<script>
	
	tinymce.init({
    selector: 'textarea.tinymce',
	toolbar: ' undo redo | styleselect fontselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | charmap | paste pastetext | fullscreen' ,
	plugins: [
      'advlist autolink lists charmap preview hr link',
      'searchreplace wordcount visualblocks visualchars code fullscreen nonbreaking',
      'table paste imagetools autosave media codesample'
    ],
	removed_menuitems: 'newdocument restoredraft', 	 
	branding: false,
	height: 500,
	autosave_retention: "0",
	convert_urls: false,
} );
	</script>
	
</head>

<body>
    <?php
	require "includes/interface/ac-navbar.php";
	require "includes/interface/ac-sidebar.php";
	?>
    
    <div id="ac-content">
		<div>
			<h3>New article</h1>
		</div>
		<div class="container-fluid editor-top">
			<div class="row">
				<div class="col-sm-12 col-md-8 col-lg-9 col-xl-9">
					<?php
					
					if (isset($ac_alert)&& !empty($ac_alert)){
						echo '<div class="ac-alert">';
						echo '<p>'.$ac_alert.'</p>';
						echo '</div>';
					}
					?>
				</div>
    			<div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">					
					<button class="btn btn-primary btn-block" type="submit" form="ac-article-new">Publish</button>	
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row editor">
				<div class="col-sm-12 col-md-8 col-lg-9 col-xl-9">
					<form id="ac-article-new"  method="post" action="article-new.php?action=new">
						<div class="form-group"><input type="text" class="form-control2 form-control-lg" name="title" placeholder="Article title" required></div>
						<div class="form-group"><button class="btn btn-primary" type="button" data-target="#add-image" data-toggle="modal">Insert image</button>
							<div role="dialog" tabindex="-1" class="modal fade" id="add-image">
    							<div class="modal-dialog modal-xl" role="document">
        						<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add image to content</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									</div>
            							<div class="modal-body">
											<div class="table-responsive table-bordered">
    		<table class="table table-striped table-bordered table-sm">
        		<thead>
           			<tr>
                		<th>ID</th>
                		<th>Image name</th>
						<th>Add</th>
            		</tr>
        		</thead>
        	<tbody>					
					<?php 
					$sql = "SELECT * FROM ".$table_prefix."images ORDER BY ID ASC";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){
						
    					while($row = $result->fetch_assoc()) {
							
						echo '<tr>';
							echo '<td>'.$row["ID"].'</td>';
							echo '<td>'.$row["image_name"].'</td>';
							echo '<td><button class="btn btn-primary btn-sm btn-add-image" type="button" aria-location="'. (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".str_replace("admin/article-new.php", "", $_SERVER['PHP_SELF']).$row["image_location"].'">Button</button></td>';
						echo '</tr>';	
							
    					}
					}
					?>
        	</tbody>
    	</table>
	</div>
                							
            							</div>
       								</div>
    							</div>
							</div>
						</div>
						<div class="form-group"><textarea class="form-control tinymce" name="content"></textarea></div>
					</form>
				</div>
    			<div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 editor-sidebar">
					<div class="editor-sidebar-part">
						<div class="informations">
							<div class="row">
								<div class="col">
									<p class="text-left">Status:</p>
								</div>
								<div class="col">
									<p class="text-right hightlight">Public</p>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<p class="text-left">Parent:</p>
								</div>
								<div class="col">
									<select name="parent" form="ac-article-new" required>
									<option value="0" selected>This article will be lonely</option>	
									<?php 
									$sql = "SELECT * FROM ".$table_prefix."pages ORDER BY ID ASC";
								$result = $conn->query($sql);

					if ($result->num_rows > 0){
						
    					while($row = $result->fetch_assoc()) {
							
						echo '<option value="'.$row["ID"].'">'.$row["page_title"].'</option>';	
							
    					}
					}
					?>
									
									</select>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
    </div>
	<script>
	
	$(function () {
	
	$('.btn-add-image').click(function (e) {
		
		var location = $(this).attr('aria-location');
		tinymce.activeEditor.execCommand('mceInsertContent', false, '<img src="'+location+'" width="100px" alt="">');
		
	});	
});
			
	</script>
    <script src="js/bootstrap.js"></script>
    <script src="js/ac-scripts.js"></script>
</body>
</html>