<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

require 'ac-config.php';

require 'includes/functions.php';

if (isset($_GET["page"])) {
	
	$url = $_GET["page"];
	
} elseif (empty($_GET["page"])) {
	
	$url = "1"; /* Index have number 1 */
		
}

if (isset($url)){
	
	$sql = "SELECT * FROM $table_prefix.posts WHERE ID='$url'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
    
    	while ($row = $result->fetch_assoc()) {
		
        	$pageContent = "<div>".$row["post_content"]."</div>";
		
			$pageTitle = $row["post_title"];
			
			$postContent[] = "";
    	}
		
	$sql2 = "SELECT * FROM $table_prefix.posts WHERE inherit='$url' AND post_type='post'";
	$result2 = $conn->query($sql2);
	
	if ($result2->num_rows > 0) {
    
    	while ($row2 = $result2->fetch_assoc()) {	
			
        	$postContent[] = "<div>".$row2["post_content"]."</div>";
    	}
	}
		
	}else {
	
	$pageTitle = "404";	
		
    $pageContent = "Page does not exist!";
		
	$postContent[] = "";	
		
	}		
}

/* Favicon type and extension for simple edit */

$favicon_type = "image/png";
$favicon_extension = "png"; /* Dot is already included */

?>	
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> <?php echo $pageTitle ?> </title>
<!-- Simple meta tags -->		
<meta name="author" content="">
<meta name="description" content=""> 
<meta name="theme-color" content="">	
<meta name="generator" content="Admin Console CORE">	
<!-- Favicons location -->		
<link rel="icon" type="<?php echo $favicon_type ?>" sizes="16x16" href="includes/img/favicon/favicon16.<?php echo $favicon_extension ?>">
<link rel="icon" type="<?php echo $favicon_type ?>" sizes="32x32" href="includes/img/favicon/favicon32.<?php echo $favicon_extension ?>">
<link rel="icon" type="<?php echo $favicon_type ?>" sizes="180x180" href="includes/img/favicon/favicon180.<?php echo $favicon_extension ?>">
<link rel="icon" type="<?php echo $favicon_type ?>" sizes="192x192" href="includes/img/favicon/favicon192.<?php echo $favicon_extension ?>">
<link rel="icon" type="<?php echo $favicon_type ?>" sizes="512x512" href="includes/img/favicon/favicon512.<?php echo $favicon_extension ?>"> 
	
<!-- <link rel="stylesheet" href="includes/css/style.css"> --> 	<!-- This is include automaticlly -->
<?php include_css() ?>
<?php include_js() ?>	
</head>

<body>
	
 <!-- Header, (Navbar, ...) -->	
<header>
</header>
	
<!-- Main, here AdminConsole show all your pages and posts -->	
<main>
	
	<?php echo $pageContent.implode($postContent)?>
	
</main>
	
<!-- Footer, (Copyright, GDPR, Cookies ) -->	
<footer>	
</footer>	
	
</body>
</html>