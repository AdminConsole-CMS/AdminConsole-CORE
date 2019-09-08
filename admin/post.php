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
	
	if($url == "save") { 
		
		$post_id = $_POST["id"];
		$post_title = $_POST["title"];
		$post_content = $_POST["content"];
		$post_inherit = $_POST["inherit"];
		
		$sql = "UPDATE $table_prefix.posts SET post_title='$post_title', post_content='$post_content', inherit='$post_inherit' WHERE ID='$post_id'";

		if ($conn->query($sql) === TRUE) {
    	
		$alert = '<div class="ac-alert" role="alert">
    				<p>Post was updated successfully!</p>
					<br>
					<p><strong>You will be redirect after 2 seconds!</strong></p>
					</div>';
		header( "refresh:2;url=post.php" );		
			
			
		} else {
    	'<div class="ac-alert" role="alert">
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
    <title>AdminConsole CORE Posts</title>
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
		<h2>Posts</h2>
		
		<?php
		if (!empty($alert)){
		echo '<div>'.$alert.'</div>';
		}
		if (isset($_GET["action"])&&isset($_GET["id"])){
			
			$action = $_GET["action"];
			$page_id = $_GET["id"];
			
			if ($action == "edit"){
				
				$sql = "SELECT * FROM $table_prefix.posts WHERE ID='$page_id' AND post_type='post'";
				$result = $conn->query($sql);
	
				if ($result->num_rows > 0) {
    
    			while ($row = $result->fetch_assoc()) {
		
        		$edit_title = $row["post_title"];
				
				$edit_content = $row["post_content"];
					
				$edit_inherit = $row["inherit"];	
					
					echo '<script src="js/tinymce/jquery.tinymce.min.js"></script>
							<script src="js/tinymce/tinymce.min.js"></script>
							<script src="js/tiny-setup.js"></script>';
					
					echo '
					<div class="container-fluid">
				<div class="row">
				<div class="col-md-8">
				<form id="pageForm" action="post.php?action=save" method="post">
				<input type="hidden" name="id" value="'.$page_id.'" >
				<input class="form-control form-control-lg text-center" style="margin-bottom: 10px" type="text" name="title" placeholder="Enter Title" value="'.$edit_title.'" required>';
					
				$sql2 = "SELECT * FROM $table_prefix.posts WHERE ID='$edit_inherit' AND post_type='page'";
				$result2 = $conn->query($sql2);
	
				if ($result2->num_rows > 0) {
    
    			while ($row2 = $result2->fetch_assoc()) {
					
					$edit_inherit_name = $row2["post_title"];
					
					echo '<div class="ac-alert" style="margin-bottom: 10px" role="alert">
    				<p>At the moment is post under the page <strong>'.$edit_inherit_name.'</strong>!</p>
					</div>';
				}
				}
					
				echo '<select name="inherit" style="margin-bottom: 10px">';
					if (isset($edit_inherit_name)) {
						
						echo '<option value="'.$edit_inherit.'">'.$edit_inherit_name.'</option>';
					}	
					echo '<option value="0">This post will be shown lonely!</option>';	
					
					$sql3 = "SELECT * FROM $table_prefix.posts WHERE post_type='page'";
					$result3 = $conn->query($sql3);
	
					if ($result3->num_rows > 0) {
    
    				while ($row3 = $result3->fetch_assoc()) {
	
					
					echo '<option value="'.$row3["ID"].'">'.$row3["post_title"].'</option>';
				}
				}
					echo '</select>';		
					
				echo '<textarea class="tinymce"  name="content" >'.$edit_content.'</textarea>	
				</form>	
				</div>
				<div class="col-md-4">
				<button class="btn btn-primary btn-lg btn-block" style="padding: .5rem 1rem!important" type="submit" form="pageForm">Save</button>
				</div>
				</div>
				</div>	';
					
    			}
				
			} 
			
		} elseif ($action == "delete"){
				
				$sql = "DELETE FROM $table_prefix.posts WHERE ID='$page_id'";

					if ($conn->query($sql) === TRUE) {
    				echo '<div class="ac-alert" role="alert">
    				<p>Post was deleted successfully!</p>
					</div>';	
						
						} else {
						
    			echo '<div class="ac-alert" role="alert">
    					<p>Error: ' . $sql . ' </p>
						<p>Error: ' . $conn->error.' </p>	
						</div>';
						
						}
				
			}
		} elseif (empty($_GET["action"])) {
			
			echo '<div class="table-responsive">
    				<table class="table table-striped">
        			<thead>
            		<tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date and Time</th>
                <th>Edit</th>
                <th>Delete</th>
            	</tr>
				</thead>
				<tbody>';
			
			$sql = "SELECT * FROM $table_prefix.posts WHERE post_type='post'";
				$result = $conn->query($sql);
	
				if ($result->num_rows > 0) {
    
    			while ($row = $result->fetch_assoc()) {
					
					echo '
        		
            	<tr>
                <td>'.$row["ID"].'</td>
                <td>'.$row["post_title"].'</td>
                <td>'.$row["post_date"].'</td>
                <td><a class="btn btn-success" role="button" href="post.php?action=edit&id='.$row["ID"].'">Edit: '.$row["post_title"].'</a></td>
                <td><a class="btn btn-danger" role="button" href="post.php?action=delete&id='.$row["ID"].'">Delete: '.$row["post_title"].'</a></td>
            	</tr>';
					
				}
				}
			echo '
        </tbody>
    </table>
</div>';
		}
		
		?>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ac-fullscreen.js"></script>
    <script src="js/ac-sidebar-collapse.js"></script>
</body>

</html>