<?php
    include('login-header.php');
?>

<div class="row vertical-offset-100">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default login-panel">
		  	<div class="panel-heading panel-login">
		  		<h1 class="text-center">
					<center>
						<img src="assets/images/logo.png" class="img-responsive img-fluid mx-auto d-block">
					</center>
				</h1>
		 	</div>
		  	<div class="panel-body">
		    	<form accept-charset="UTF-8" role="form" method="POST" action="index.php" id="login_form">
                    <?php include('includes/errors.php'); ?>
	                <fieldset>
			    	  	<div class="input-group form-group">
			    	  		<div class="input-group-addon">@</div>
			    		    <input class="form-control required" name="username" id="username" type="text" placeholder="Username" autocomplete="off" required>
			    		</div>
			    		<div class="input-group form-group">
			    		 	<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
			    			<input class="form-control required" placeholder="Password" name="password" type="password" placeholder="Enter Password" required>
			    		</div>
			    		<button type="submit" id="btn-login" name="login_user" class="btn btn-success btn-block">Login</button><br>
			    	</fieldset>
		      	</form>
		    </div>
		</div>
	</div>
</div>

<?php
	include('footer.php');
?>