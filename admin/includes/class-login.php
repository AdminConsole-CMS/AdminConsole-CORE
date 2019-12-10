<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

class AC_Login{
	
	private $ac_alert;
	
	function checker(){
		
		if(isset($_GET["action"])){
			$this->controller();
		}		
	}
	
	function controller(){
			
		switch ($_GET["action"]){ 
				
			case "login":
				$this->login();
				break;
			case "logout":
				$this->logout();
				break;
			default: header("Location: ".$_SERVER['PHP_SELF']);				
		}		
	}
	
	function login(){
		
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
		$this->login_checker();
			
		}		
	}
	
	function logout(){
		
		session_start();
		session_destroy();
		header("Location: login.php");
		
	}
	
	function login_checker(){	
			
		if(isset($_REQUEST["username"]) && isset($_REQUEST["password"])){

			if(!empty($_REQUEST["username"]) && !empty($_REQUEST["password"])){
				$this->login_cookie();
				$this->login_username();
			}else {
				$this->ac_alert = 'Invalid Log In informations';
				echo '<h5 class="red">Invalid Log In informations</h5>';
				exit;
			}			
		}
	}
	
	function login_username(){
		
		if(strtolower($this->select(3)) == strtolower($_REQUEST["username"])){
			
			session_start();
			$_SESSION["AC-ADMIN-USERNAME"] = $this->select(3);
			$this->login_password();	
		}else {
			$this->ac_alert = 'Invalid Log In informations';
			echo '<h5 class="red">Invalid Log In informations</h5>';
			exit;
		}		
	}
	
	function login_password(){
		
		if(password_verify($_REQUEST["password"], $this->select(4))){	
			echo 'success';
			//header("Location: inde.php");
			exit;
		}else {
			$this->ac_alert = 'Invalid Log In informations';
			echo '<h5 class="red">Invalid Log In informations</h5>';
			exit;
		}		
	}
	
	function login_cookie(){
		
		if(isset($_REQUEST['remember'])){
			
			$remember = $_REQUEST['remember'];
			if($remember == TRUE){			
				setcookie("username", $_REQUEST["username"], time() + (86400), "/");	
			}		
		}else {
			setcookie("username", "", time() - (86400 * 30), "/");
		}		
	}
	
	function select($id){
		global $conn;
		global $table_prefix;
		
		$sql = "SELECT value FROM ".$table_prefix."settings WHERE ID='$id'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				return $row["value"];
			}
		}
		
	}
	
	function alert(){
		
		if(!empty($this->ac_alert)){
			
			echo '<h5 class="red">'.$this->ac_alert.'</h5>';	
			
		}	
	}	
}

?>