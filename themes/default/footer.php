<footer class="footer">
    <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Invalid</a></li>
    </ul>
    <p class="copyright">
		<?php 
		
		$sql_settings = "SELECT value FROM ".$table_prefix."settings WHERE ID='1'";
		$result_settings = $conn->query($sql_settings);

		if ($result_settings->num_rows > 0){
			while($row_settings = $result_settings->fetch_assoc()) {
				echo $row_settings["value"];
			}
		}
		
		?> © <?php echo date("Y")?></p>
</footer>