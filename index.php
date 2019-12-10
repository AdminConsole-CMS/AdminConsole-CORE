<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

if(!file_exists('ac-config.php')){
	header("Location: install/index.php");
}else{
	require 'ac-config.php';
}

if (file_exists('ac-update.php')){
	header("Location: ac-update.php");
}

if (file_exists('ac-upgrade.php')){
	header("Location: ac-upgrade.php");
}

$sql_settings = "SELECT value FROM ".$table_prefix."settings WHERE ID='5'";
$result_settings = $conn->query($sql_settings);

if ($result_settings->num_rows > 0){
	while($row_settings = $result_settings->fetch_assoc()) {
		date_default_timezone_set($row_settings["value"]);
	}
}

if (isset($_GET["p"])) {
	
	$name = $_GET["p"];
	$sql = "SELECT * FROM ".$table_prefix."pages WHERE page_name='$name'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
    
    	while ($row = $result->fetch_assoc()) {
		
        	$pageContent = "<div>".$row["page_content"]."</div>";
		
			$pageTitle = $row["page_title"];
			
			$articleContent[] = "";
			
			$pageID = $row["ID"];
    	}
		
	$sql2 = "SELECT * FROM ".$table_prefix."articles WHERE article_type='i' AND article_parent='$pageID'";
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
	
	$sql = "SELECT * FROM ".$table_prefix."pages WHERE ID='1'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
    
    	while ($row = $result->fetch_assoc()) {
		
        	$pageContent = "<div>".$row["page_content"]."</div>";
		
			$pageTitle = $row["page_title"];
			
			$articleContent[] = "";
    	}
		
	$sql2 = "SELECT * FROM ".$table_prefix."articles WHERE article_type='i' AND article_parent='1'";
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
	
<?php
	
$sql_settings = "SELECT value FROM ".$table_prefix."settings WHERE ID='2'";
$result_settings = $conn->query($sql_settings);

if ($result_settings->num_rows > 0){
	while($row_settings = $result_settings->fetch_assoc()) {
		echo '<meta name="description" content="'.$row_settings["value"].'">';
	}
}
	
?>	
 

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