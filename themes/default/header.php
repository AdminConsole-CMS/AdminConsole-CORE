<nav class="navbar navbar-light navbar-expand-md">
    <div class="container-fluid"><a class="navbar-brand" href="#">
		<?php 
		
		$sql_settings = "SELECT value FROM ".$table_prefix."settings WHERE ID='1'";
		$result_settings = $conn->query($sql_settings);

		if ($result_settings->num_rows > 0){
			while($row_settings = $result_settings->fetch_assoc()) {
				echo $row_settings["value"];
			}
		}
		
		?>
		</a><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li role="presentation" class="nav-item"><a class="nav-link active" href="#">First Item</a></li>
            </ul>
        </div>
    </div>
</nav>