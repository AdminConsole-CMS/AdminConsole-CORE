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

$alert = "";

if (isset($_GET["action"])) {
	
	$url = $_GET["action"];
	
	if($url == "add") { 
		
		$post_title = $_POST["title"];
		$post_content = $_POST["content"];
		$post_inherit = $_POST["inherit"];
		
		$sql = "INSERT INTO $table_prefix.posts (post_title, post_content, post_type, inherit)
		VALUES ('$post_title','$post_content' , 'post', '$post_inherit')";

		if ($conn->query($sql) === TRUE) {
			
    	$alert = '<div class="ac-alert" role="alert">
    				<p>Post was added successfully!</p>
					<br>
					<p><strong>You will be redirect after 2 seconds!</strong></p>
					</div>';
		header( "refresh:2;url=post-new.php" );	
			
		} else {
			
			$alert = '<div class="ac-alert" role="alert">
    					<p>Error: ' . $sql . ' </p>
						<p>Error: ' . $conn->error.' </p>	
						</div>';
			
		}
			
	}
	
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AdminConsole CORE Add new post</title>
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
	<script src="js/tinymce/jquery.tinymce.min.js"></script>
	<script src="js/tinymce/tinymce.min.js"></script>
	<script src="js/tiny-setup.js"></script>
</head>

<body>
    <?php
	require "includes/admin-navbar.php";
	require "includes/admin-sidebar.php";
	?>
    
    <div id="ac-content">
		<h2>Add post</h2>
		<div class="container-fluid">
		<div><?php echo $alert ."<br>"?></div>	
		<div class="row">
		<div class="col-md-8">
		<form id="pageForm" action="post-new.php?action=add" method="post">
		<input class="form-control form-control-lg text-center" style="margin-bottom: 10px" type="text" name="title" placeholder="Enter Title" required>
		<select name="inherit" style="margin-bottom: 10px">
		<option value="0">This post will be shown lonely!</option>	
		<?php 
	
		$sql = "SELECT * FROM $table_prefix.posts WHERE post_type='page'";
		$result = $conn->query($sql);
	
		if ($result->num_rows > 0) {
    
    	while ($row = $result->fetch_assoc()) {
		
        	echo '<option value="'.$row["ID"].'">'.$row["post_title"].'</option>';
    	}
			}
			
		?>	
		</select>
		<div class="ac-alert" style="margin-bottom: 10px" role="alert" ><p>This post will be inherit to page if you select it. If not then will be shown alone as page! You can change it later.</p>	</div>
		<textarea class="tinymce"  name="content"></textarea>	
		</form>	
		</div>
		<div class="col-md-4">
		<button class="btn btn-primary btn-lg btn-block" style="padding: .5rem 1rem!important" type="submit" form="pageForm">Save</button>
			</div>
		</div>
		</div>	
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ac-fullscreen.js"></script>
    <script src="js/ac-sidebar-collapse.js"></script>
</body>

</html>