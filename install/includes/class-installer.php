<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

class AC_Installer{
	
	private $view;
	private $ac_alert;
	
	private $site_sitename;
	private $site_description;
	private $site_timezone;
	private $site_username;
	private $site_password;
	
	private $db_host;
	private $db_name;
	private $db_username;
	private $db_password;
	private $db_prefix;
	
	function checker(){
		
		if(isset($_GET["step"])){
			
			$this->controllerStep();
			
		}elseif(isset($_GET["action"])){
			
			$this->controllerAction();
			
		}else{
			$this->step_main();
		}		
	}
	
	function controllerAction(){
		
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			if (isset($_GET["action"])){
			
				if(!empty($_GET["action"])){	

					switch ($_GET["action"]){

						case "main":
							$this->action_main();
							break;
						case "db":
							$this->action_db();
							break;
						case "db-install":
							$this->action_install();
							break;	
						case "db-test":
							$this->action_db_test();
							break;
						case "delete-install":
							$this->action_delete_install();
							break;		
					}			

				}else {

					$this->ac_alert = 'Action was not set!';

				}
			}			
		}	
	}
	
	function controllerStep(){
		
		if (isset($_GET["step"])){	
			
			if(!empty($_GET["step"])){	
				
				if($_GET["step"] == "db"){
					
					$this -> step_db();		
					
				}elseif($_GET["step"] == "main"){
					
					header("Location: index.php");
					
				}elseif($_GET["step"] == "install"){
					
					$this -> step_install();	
					
				}				
			}else {				
				$this->ac_alert = 'Step was not set!';				
			}		
			
		}else {
			
			$this -> step_main();
			
		}		
	}
	
	function step_main(){	
		$this->view = 'main';
	}
	
	function step_install(){
		
		$this->action_install();
		
	}
	
	function step_db(){
		$this->view = 'db';		
	}
	
	function random_prefix(){
		
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		
    	$charactersLength = strlen($characters);
		
    	$randomstring = '';
		
    	for ($i = 0; $i < "5"; $i++) {
			
        	$randomstring .= $characters[rand(0, $charactersLength - 1)];
			
    	}
        $_SESSION["random_prefix"] = $randomstring;
	}
	
	function view(){
		
		if(!empty($this->view)){
			
			require 'step/step-'.$this->view.'.php';	
			
		}	
	}
	
	function action_main(){
		
		if(isset($_POST["sitename"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["repeate-password"])){
			
			if($_POST["password"] == $_POST["repeate-password"]){
				
				$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
				
				$sitename = $_POST["sitename"];
				$username = $_POST["username"];
				
				if(isset($_POST["site-description"])){
					
					$_SESSION["site-description"] = $_POST["site-description"];
					
				}				
				
				if(isset($_POST["bws-timezone-check"])){
					
					if(($_POST["bws-timezone-check"]) == TRUE){
						
						$_SESSION["site-timezone"] = $_POST["bws-timezone"];
						$_SESSION["site-sitename"] = $sitename;
						$_SESSION["site-username"] = $username;
						$_SESSION["site-password"] = $password;
						echo "success";
						exit;
					}
					
				}else {
					
					$_SESSION["site-timezone"] = $_POST["timezone"];
					$_SESSION["site-sitename"] = $sitename;
					$_SESSION["site-username"] = $username;
					$_SESSION["site-password"] = $password;
					echo "success";
					exit;		
				}
				
			}else {
				
				echo "Passwords still do not match!";
			}			
		}
		exit;		
	}
	
	function action_db(){
		
		if(isset($_POST["db-host"]) && isset($_POST["db-name"]) && isset($_POST["db-username"]) && isset($_POST["db-prefix"])){
			
			if(!empty($_POST["db-host"]) && !empty($_POST["db-name"]) && !empty($_POST["db-username"]) && !empty($_POST["db-prefix"])){
				
				
				$_SESSION["db-host"] = $_POST["db-host"];
				$_SESSION["db-name"] = $_POST["db-name"];
				$_SESSION["db-username"]  = $_POST["db-username"];
				$_SESSION["db-prefix"] = $_POST["db-prefix"];
				
				if(!empty($_POST["db-host"])){
					
					$_SESSION["db-password"] = $_POST["db-password"];
					
				}else {
					$_SESSION["db-password"] = '';
				}
				$this->action_db_test();
				echo "success";
				exit;
			}		
		}
		echo "Please fill all required fields!";
		exit;		
	}
	
	function action_db_test(){
		
		if(isset($_POST["db-host"]) && isset($_POST["db-name"]) && isset($_POST["db-username"])){
			
			if(!empty($_POST["db-host"]) && !empty($_POST["db-name"]) && !empty($_POST["db-username"])){
				$conn_test = new mysqli($_POST["db-host"], $_POST["db-username"], $_POST["db-password"], $_POST["db-name"]);

				if ($conn_test->connect_error) {
					echo "Cannot connect to database!";
					exit;
				}
				$this->ac_alert = "success";
				echo "success";
				exit;
			}						
		}
		exit;
	}
	
	function action_delete_install(){
		if (file_exists("../ac-config.php")) {
			rmdir('../install');
			unlink("../ac-config.php");
			echo "Install folder was successffully deleted!";
			exit;
		}
		echo "Install folder was already deleted!";
		exit;
	}
	
	function action_install(){
		
		$this->site_sitename = $_SESSION["site-sitename"];
		$this->site_description = $_SESSION["site-description"];
		$this->site_timezone = $_SESSION["site-timezone"];
		$this->site_username = $_SESSION["site-username"];
		$this->site_password = $_SESSION["site-password"];

		$this->db_host = $_SESSION["db-host"];
		$this->db_name = $_SESSION["db-name"];
		$this->db_username = $_SESSION["db-username"];
		$this->db_password = $_SESSION["db-password"];
		$this->db_prefix = $_SESSION["db-prefix"];
		
		$conn = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
		mysqli_set_charset($conn,"utf8");
		
		if ($conn->connect_error) {
			die ("Connection failed:".$conn->connect_error);
			echo $this->db_password;
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS `ac_".$this->db_prefix."_settings` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(255) NOT NULL,  `value` mediumtext NOT NULL,  PRIMARY KEY (`ID`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		
		if ($conn->query($sql) === TRUE){
			$sql2 = "INSERT INTO ac_".$this->db_prefix."_settings (name, value) VALUES ('sitename' ,'$this->site_sitename'), ('description' ,'$this->site_description'), ('username' ,'$this->site_username'), ('password' ,'$this->site_password'), ('timezone' ,'$this->site_timezone')";
			
			if ($conn->query($sql2) === TRUE){
				
				$sql3 = "CREATE TABLE IF NOT EXISTS `ac_".$this->db_prefix."_articles` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `article_date` datetime NOT NULL,  `article_date_gmt` datetime NOT NULL,  `article_title` varchar(255) NOT NULL,  `article_name` varchar(255) NOT NULL,  `article_content` longtext NOT NULL,  `article_type` varchar(255) NOT NULL,  `article_parent` int(11) NOT NULL,  PRIMARY KEY (`ID`),  UNIQUE KEY `article_name` (`article_name`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
				
				if ($conn->query($sql3) === TRUE){
					
					$sql4 = "CREATE TABLE IF NOT EXISTS `ac_".$this->db_prefix."_pages` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `page_date` datetime NOT NULL,  `page_date_gmt` datetime NOT NULL,  `page_title` varchar(255) NOT NULL,  `page_name` varchar(255) NOT NULL,  `page_content` longtext NOT NULL,  PRIMARY KEY (`ID`),  UNIQUE KEY `page_name` (`page_name`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
					
					if ($conn->query($sql4) === TRUE){
						
						$sql5 = "CREATE TABLE IF NOT EXISTS `ac_".$this->db_prefix."_images` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `image_date` datetime NOT NULL,  `image_date_gmt` datetime NOT NULL,  `image_name` mediumtext NOT NULL,  `image_alt` varchar(255) NOT NULL,  `image_size` varchar(255) NOT NULL,  `image_location` varchar(255) NOT NULL,  `image_mime` varchar(255) NOT NULL,  PRIMARY KEY (`ID`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
						
						if ($conn->query($sql5) === TRUE){
							$file = fopen("../config-values.txt", "w");
							$txt = "Database host: ".$this->db_host."\n";
							$txt .= "Database username: ".$this->db_username."\n";
							$txt .= "Database password: ".$this->db_password."\n";
							$txt .= "Database name: ".$this->db_name."\n";
							$txt .= "Database table prefix: ".$this->db_prefix."_\n";
							fwrite($file, $txt);
							$this->ac_alert = "AdminConsole CORE was successfully installed!";
							$this->view = 'install';							
						}						
					}	
				}					
			}			
		}
		session_destroy();
	}
	
	function alert(){
		
		if(!empty($this->ac_alert)){
			
			return '<div class="ac-installation-info"><h5 class="red">'.$this->ac_alert.'</h5></div>';	
			
		}	
	}
}

?>