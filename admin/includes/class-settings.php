<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

class AC_Settings{
	
	private $ac_alert;
	
	function checker(){
		
		if(isset($_GET["action"])){
			$this->controller();
		}		
	}
	
	function controller(){
		
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			switch ($_GET["action"]) {
				
				case "site":
					$this->update_site();
					break;
				case "username":
					$this->update_username();
					break;
				case "password":
					$this->update_password();
					break;
				case "timezone":
					$this->update_timezone();
					break;	
				default: header("Location: ".$_SERVER['PHP_SELF']);				
			}
			
		}else{			
			header("Location: ".$_SERVER['PHP_SELF']);			
		}		
	}
	
	function update_site(){	
		
		if(isset($_POST["description"])){
			
			$description = $_POST["description"];			
			$this->update($description, 2);
			
			if(isset($_POST["sitename"])){
				
				$sitename = $_POST["sitename"];
				$this->update($sitename, 1);
				
			}
			
		}else{
			
			if(isset($_POST["sitename"])){
				
				$sitename = $_POST["sitename"];
				$this->update($sitename, 1);
				
			}			
		}		
	}
	
	function update_timezone(){	
		
		if(isset($_POST["timezone"])){
			
			$timezone = $_POST["timezone"];			
			$this->update($timezone, 5);
			
		}		
	}
	
	function update_username(){
		
		if(isset($_POST["username"])){
			
			if(!empty($_POST["username"])){
				$username = $_POST["username"];			
				$this->update($username, 3);
				session_start();
				$_SESSION["AC-ADMIN-USERNAME"] = $username;
			}else {
				$this->ac_alert = 'Fill username!';
			}			
		}		
	}
	
	function update_password(){
		
		if(isset($_POST["old-password"]) && isset($_POST["new-password"]) && isset($_POST["repeate-password"])){
			
			if(!empty($_POST["old-password"]) && !empty($_POST["new-password"]) && !empty($_POST["repeate-password"])){
				
				$old = $_POST["old-password"];
				$new = $_POST["new-password"];
				$repeate = $_POST["repeate-password"];
				
				if($new == $repeate){
					
					global $conn;
					global $table_prefix;
					
					$sql = "SELECT value FROM ".$table_prefix."settings WHERE ID='4'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){
						while($row = $result->fetch_assoc()) {
							$old_hash = $row["value"];
						}
					}
					
					if(password_verify($old, $old_hash)){
						
						$new_hash = password_hash($new, PASSWORD_BCRYPT);
						$this->update($new_hash,4);
												
					}else {
						$this->ac_alert = 'Old password is wrong!';
					}	
					
				}else {
					$this->ac_alert = 'Passwords do not match!';
				}
				
			}else {
				$this->ac_alert = 'Fill fields!';
			}
		}		
	}
	
	function update($value, $id){
		
		global $conn;
		global $table_prefix;
		
		$sql = "UPDATE ".$table_prefix."settings SET value='$value' WHERE ID='$id'";
		
		if ($conn->query($sql) === TRUE){
			
			header("Location: ".$_SERVER['PHP_SELF']);
			
		}else {
			
			$this->ac_alert = 'Error!';
			
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
			
			return '<div class="ac-alert"><p>'.$this->ac_alert.'</p></div>';	
			
		}	
	}	
}

?>