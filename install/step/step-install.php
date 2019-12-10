<div>
	<div id="post-alert" class="ac-installation-info" style="display: none;"><h5 class="red"></h5></div>
	<h1 class="text-center">Thank YOU</h1>
	<div>
		<h2>Installation</h2>
	</div>
	<div class="form-group">
		<h6>Now rename <strong>ac-config-sample.php</strong> in root folder to <strong>ac-config.php</strong><br>Then just insert same informations to database into this fiedls:</h6>
		<ol>
			<li> define("AC_DB_HOST", "HERE YOUR VALUE")</li>
			<li> define("AC_DB_USERNAME", "HERE YOUR VALUE")</li>
			<li> define("AC_DB_PASSWORD", "HERE YOUR VALUE")</li>
			<li> define("AC_DB_NAME", "HERE YOUR VALUE")</li>
			<li>$table_prefix  .= 'HERE YOUR VALUE' <span class="text-danger">Do not change first table prefix value <strong>ac_</strong> but second because you will then need to change all tables prefixes!</span></li>
		</ol>
		<p class="text-success">All this informations you will find in <strong>config-values.txt</strong><br><span class="text-danger"><strong>For security reasons delete folder install in your root folder and config-values.txt</strong></span></p>
	</div>
	<div><a href="../admin/login.php" target="_blank">Go to administration</a></div>
	<div><a href="../index.php" target="_blank">Go to site</a></div>
</div>