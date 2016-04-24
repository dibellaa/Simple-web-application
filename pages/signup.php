<?php include 'head.php'; ?>
<?php if(isset($_COOKIE['set'])) { ?>
<div class="col-xs-8 panel login-panel">
	<div class="panel-heading">
		<h2 class="panel-title">Registration</h2>
	</div>
	<div class="panel-body">
		<label for="reg">Insert an username and a password:</label>
		<form role="form" id="freg" method="post" action="auth.php">
			<fieldset>
				<div class="form-group">
					<input class="form-control" placeholder="Username" name="user" type="text" autofocus required>
				</div>
				<div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                </div>
                    <input type="submit" class="btn btn-lg btn-primary btn-block" name="reg" value="Sign Up!">
			</fieldset>
		</form>
	</div>
</div>
<?php } ?>
<?php include 'foot.php'; ?>