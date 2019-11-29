<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

session_start();
require "../ac-config.php";
include "includes/functions.php";
if (empty($_SESSION["AC-ADMIN-USERNAME"])) {
	
	header("Location: ../ac-login.php");
	
	}
if (isset($_GET["action"])){
	
	switch ($_GET["action"]) {
			
			case "update":
				
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
					
					if (isset($_POST["id"])){
						
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
	
					$sql = "UPDATE articles SET article_title='$article_title', article_name='$article_name', article_content='$article_content', article_type='$article_type', article_parent='$article_parent'  WHERE ID=".$_POST["id"]."";

						if ($conn->query($sql) === TRUE) {
    	header("Location: article.php");
	
							}					
						}														
					}
				break;
			
			case "delete":
					
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					
					if (isset($_POST["id"])){
	
					$sql = "DELETE FROM articles WHERE ID=".$_POST["id"]."";

								if ($conn->query($sql) === TRUE) {
								
									$ac_alert = "Article is successfully deleted!";
								}						
						}														
					}
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
			<h3>Articles <a href="article-new.php" class="btn btn-primary">Add new</a></h1>
		</div>
		<?php
					
					if (isset($ac_alert)&& !empty($ac_alert)){
						echo '<div class="ac-alert">';
						echo '<p>'.$ac_alert.'</p>';
						echo '</div>';
					}
					?>
		<?php 
		
		if(!isset($_GET["action"])){
			echo '<div>
		<div class="table-responsive table-bordered">
    		<table class="table table-striped table-bordered table-sm">
        		<thead>
           			<tr>
                		<th>ID</th>
                		<th>Article title</th>
                		<th>Article name</th>
                		<th>Article date</th>
                		<th>Article date GMT</th>
						<th>Edit</th>
						<th>Delete</th>
            		</tr>
        		</thead>
        	<tbody>';					
					$sql = "SELECT * FROM articles ORDER BY ID asc";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){
						
    					while($row = $result->fetch_assoc()) {
							
						echo '<tr>';
							echo '<td>'.$row["ID"].'</td>';
							echo '<td>'.$row["article_title"].'</td>';
							echo '<td>'.$row["article_name"].'</td>';
							echo '<td>'.$row["article_date"].'</td>';
							echo '<td>'.$row["article_date_gmt"].'</td>';
							echo '<td><form method="post" action="article.php?action=edit"><input type="hidden" name="id" value="'.$row["ID"].'"><button class="btn btn-success btn-sm" type="submit">Edit</button></form></td>';
							echo '<td><form method="post" action="article.php?action=delete"><input type="hidden" name="id" value="'.$row["ID"].'"><button class="btn btn-danger btn-sm" type="submit" aria-id="">Delete</button></form></td>';
						echo '</tr>';	
							
    					}
					} else {
						echo '<tr>';
    						echo '<td colspan="7" class="text-center">No articles!</td>';
						echo '</tr>';
					}
echo '
        	</tbody>
    	</table>
	</div>	
	</div>';
		}elseif ($_GET["action"] == "delete"){
			echo '<div>
		<div class="table-responsive table-bordered">
    		<table class="table table-striped table-bordered table-sm">
        		<thead>
           			<tr>
                		<th>ID</th>
                		<th>Article title</th>
                		<th>Article name</th>
                		<th>Article date</th>
                		<th>Article date GMT</th>
						<th>Edit</th>
						<th>Delete</th>
            		</tr>
        		</thead>
        	<tbody>';					
					$sql = "SELECT * FROM articles ORDER BY ID asc";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){
						
    					while($row = $result->fetch_assoc()) {
							
						echo '<tr>';
							echo '<td>'.$row["ID"].'</td>';
							echo '<td>'.$row["article_title"].'</td>';
							echo '<td>'.$row["article_name"].'</td>';
							echo '<td>'.$row["article_date"].'</td>';
							echo '<td>'.$row["article_date_gmt"].'</td>';
							echo '<td><form method="post" action="article.php?action=edit"><input type="hidden" name="id" value="'.$row["ID"].'"><button class="btn btn-success btn-sm" type="submit">Edit</button></form></td>';
							echo '<td><form method="post" action="article.php?action=delete"><input type="hidden" name="id" value="'.$row["ID"].'"><button class="btn btn-danger btn-sm" type="submit" aria-id="">Delete</button></form></td>';
						echo '</tr>';	
							
    					}
					} else {
						echo '<tr>';
    						echo '<td colspan="7" class="text-center">No articles!</td>';
						echo '</tr>';
					}
echo '
        	</tbody>
    	</table>
	</div>	
	</div>';
		
		}elseif ($_GET["action"] == "edit"){
			
			$id = $_POST['id'];
			$sql = "SELECT * FROM articles WHERE ID='$id'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){
						
    					while($row = $result->fetch_assoc()) {
							
						echo '
						
						
						
								<div class="container-fluid editor-top">
			<div class="row">
				<div class="col-sm-12 col-md-8 col-lg-9 col-xl-9">';
					
					if (isset($ac_alert)&& !empty($ac_alert)){
						echo '<div class="ac-alert">';
						echo '<p>'.$ac_alert.'</p>';
						echo '</div>';
					}
				echo '</div>
    			<div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">					
					<button class="btn btn-primary btn-block" type="submit" form="ac-article-update">Publish</button>	
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row editor">
				<div class="col-sm-12 col-md-8 col-lg-9 col-xl-9">
					<form id="ac-article-update"  method="post" action="article.php?action=update">
					<input type="hidden" name="id" value="'.$row["ID"].'">
						<div class="form-group"><input type="text" class="form-control2 form-control-lg" name="title" placeholder="Article title" value="'.$row["article_title"].'" required></div>
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
        	<tbody>	';				
					$sql2 = "SELECT * FROM images ORDER BY ID ASC";
					$result2 = $conn->query($sql2);

					if ($result2->num_rows > 0){
						
    					while($row2 = $result2->fetch_assoc()) {
							
						echo '<tr>';
							echo '<td>'.$row2["ID"].'</td>';
							echo '<td>'.$row2["image_name"].'</td>';
							echo '<td><button class="btn btn-primary btn-sm btn-add-image" type="button" aria-location="'. (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".str_replace("admin/article.php", "", $_SERVER['PHP_SELF']).$row2["image_location"].'">Button</button></td>';
						echo '</tr>';	
							
    					}
					}
					echo '
        	</tbody>
    	</table>
	</div>
                							
            							</div>
       								</div>
    							</div>
							</div>
						</div>
						<div class="form-group"><textarea class="form-control tinymce" name="content">'.$row["article_content"].'</textarea></div>
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
									<select name="parent" form="ac-article-update" required>
									';
							if ($row["article_type"] == "a"){
								echo '<option value="0" selected>This article will be lonely</option>';
							}elseif ($row["article_type"] == "i"){
								echo '<option value="'.$row["article_parent"].'" selected>'; 
								$parent = $row["article_parent"];
								$sql4 = "SELECT * FROM pages WHERE ID=$parent";
								$result4 = $conn->query($sql4);

					if ($result4->num_rows > 0){
						
    					while($row4 = $result4->fetch_assoc()) {
							
						echo $row4["page_title"];	
							
    					}
					}echo'</option>	';
								echo '<option value="0">This article will be lonely</option>';
							}
									$sql3 = "SELECT * FROM pages ORDER BY ID ASC";
								$result3 = $conn->query($sql3);

					if ($result3->num_rows > 0){
						
    					while($row3 = $result3->fetch_assoc()) {
							
						echo '<option value="'.$row3["ID"].'">'.$row3["page_title"].'</option>';	
							
    					}
					}
					echo '
									
									</select>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
						';	
							
    					}
					}
		}
		
		?>
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