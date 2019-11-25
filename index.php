<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

require 'ac-config.php';

if (file_exists('ac-update.php')){
	header("Location: ac-update.php");
}

if (file_exists('ac-upgrade.php')){
	header("Location: ac-upgrade.php");
}

if (isset($_GET["p"])) {
	
	$name = $_GET["p"];
	$sql = "SELECT * FROM pages WHERE page_name='$name'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
    
    	while ($row = $result->fetch_assoc()) {
		
        	$pageContent = "<div>".$row["page_content"]."</div>";
		
			$pageTitle = $row["page_title"];
			
			$articleContent[] = "";
			
			$pageID = $row["ID"];
    	}
		
	$sql2 = "SELECT * FROM articles WHERE article_type='i' AND article_parent='$pageID'";
	$result2 = $conn->query($sql2);
	
	if ($result2->num_rows > 0) {
    
    	while ($row2 = $result2->fetch_assoc()) {	
			
        	$articleContent[] = "<div>".$row2["article_content"]."</div>";
    	}
	}
		
	}else {
	
	$pageTitle = "404";	
		
    $pageContent = "Page does not exist!";
		
	$articleContent[] = "";	
		
	}
	
} elseif (empty($_GET["p"])) {
	
	$sql = "SELECT * FROM pages WHERE ID='1'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
    
    	while ($row = $result->fetch_assoc()) {
		
        	$pageContent = "<div>".$row["page_content"]."</div>";
		
			$pageTitle = $row["page_title"];
			
			$articleContent[] = "";
    	}
		
	$sql2 = "SELECT * FROM articles WHERE article_type='i' AND article_parent='1'";
	$result2 = $conn->query($sql2);
	
	if ($result2->num_rows > 0) {
    
    	while ($row2 = $result2->fetch_assoc()) {	
			
        	$articleContent[] = "<div>".$row2["article_content"]."</div>";
    	}
	}
		
	}else {
	
	$pageTitle = "404";	
		
    $pageContent = "Page does not exist!";
		
	$articleContent[] = "";	
		
	}	
		
}

?>	
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<title> <?php echo $pageTitle ?> </title>
	
<meta name="author" content="">
<meta name="description" content=""> 

<?php require "themes/default/head.php"; ?>
</head>

<body>
<?php require "themes/default/header.php"; ?>
<main class="container">
	<?php 
	
	echo $pageContent.implode($articleContent);
	
	?>
</main>	
<?php require "themes/default/footer.php"; ?>		
</body>
</html>