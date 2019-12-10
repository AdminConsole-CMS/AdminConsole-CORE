<div>
	<div id="post-alert" class="ac-installation-info" style="display: none;"><h5 class="red"></h5></div>
	<form action="index.php?action=db" method="post">
		<div class="row">
			<div class="col-md-6">
				<h2>Database configuration</h2>
			</div>
			<div class="col-md-6">
				<div class="form-group text-right">
					<button class="btn btn-primary" type="submit">Install&nbsp;»</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Database type</label>
					<div class="back">
						<input type="text" class="form-control" name="db-type" value="mysqli" readonly>												
					</div>
				</div>
				<div class="form-group">
					<label>Database host*</label>
					<div class="back">
						<input type="text" class="form-control" name="db-host" value="localhost" required>	
					</div>
				</div>
				<div class="form-group">
					<label>Database name*</label>
					<div class="back">
						<input type="text" class="form-control" name="db-name" required>	
					</div>
				</div>
				<div class="form-group">
					<label>Database prefix*</label>
					<div class="back">
						<input type="text" id="table-name" class="form-control" name="db-prefix" value="<?php echo $_SESSION["random_prefix"]; ?>" maxlength="5"  onKeyUp="table_name_example()" pattern="[a-z0-9]+">	
					</div>
					<small class="form-text text-danger">Only numbers and lowercase, no special chars. Maximum 5 characters.</small>
					<small class="form-text text-black-50">Example: <span>8xfw6</span></small>
					<small class="form-text">Database table will look like: <span>ac_<span id="table-name-example" class="text-primary"></span>_<span>table name</span></span></small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Database username*</label>
					<div class="back">
						<input type="text" class="form-control" name="db-username" value="root" required>	
					</div>
				</div>
				<div class="form-group">
					<label>Database password*</label>
					<div class="back">
						<input type="text" class="form-control" name="db-password">	
					</div>
				</div>
				<div class="form-group">
					<label>Database connection test <span class="text-primary">(optional)</span></label>
					<div>												
						<button id="connection-test" class="btn btn-success" type="submit">Start test</button>
					</div>
				</div>
				<div class="form-group">
					<div>
						<div id="connection-test-load" class="spinner-border text-success" role="status" style="display: none;"></div>	
						<div id="connection-test-result" class="alert alert-success" role="alert" style="display: none;">
						  <strong></strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			</div>
			<div class="col-md-6">
				<div class="form-group text-right">									
					<button class="btn btn-primary" type="submit">Install&nbsp;»</button>
				</div>
			</div>
		</div>
	</form>		
	<script>
		document.onload = table_name_example();

		function table_name_example(){
			document.getElementById("table-name-example").innerHTML = document.getElementById("table-name").value;
		}		
	</script>
	<script>
		$(function () {	
			$('#connection-test').click(function () {
				$('#connection-test-load').show();
				$('form').submit(function (e){
					e.preventDefault();

					$.ajax({
						type: 'post',
						url: 'index.php?action=db-test',
						data: $(this).serialize(),
						success: function (data) {
							if (data == "success"){
								$('#connection-test-result').removeClass("alert-danger").addClass("alert-success");
								$('#connection-test-load').hide();
								$('#connection-test-result').show();
								$('#connection-test-result strong').html('Connection successful!');
							}else {
								$('#connection-test-result').removeClass("alert-success").addClass("alert-danger");
								$('#connection-test-load').hide();
								$('#connection-test-result').show();
								$('#connection-test-result strong').html('Connection unccessful!');
							}
						}
					});
				});
			});
			
			$('.btn-primary').click(function () {
				$('form').submit(function (e){
					
					e.preventDefault();
					var post_url = $(this).attr('action');
					
					$.ajax({
						type: 'post',
						url: post_url,
						data: $(this).serialize(),
						success: function (data) {
							if(data == "success"){
								window.location = "index.php?step=install";
							}else{
								$('#post-alert').show();
								$('#post-alert h5').html(data);																
							}
						}
					});
				});
			});
			
		});
	</script>
</div>