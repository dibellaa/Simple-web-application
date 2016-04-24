<?php include 'head.php';?>
<?php if(isset($_COOKIE['set'])) { ?>
<?php

if(isset($_SESSION['auth'])){
	$auth = (!empty($_COOKIE['auth'])) && ($_COOKIE['auth'] === $_SESSION['auth']);
}
else 
    $auth=false;

if(!$auth) { ?>
<div class="col-xs-8 panel login-panel">
	<div class="panel-heading">
		<h2 class="panel-title">Please Sign In</h2>
	</div>
	<div class="panel-body">
		<form role="form" id="flog" method="post" action="auth.php">
			<fieldset>
				<div class="form-group">
					<input class="form-control" placeholder="Username" name="user" type="text" autofocus required>
				</div>
				<div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                </div>
                    <input type="submit" class="btn btn-lg btn-primary btn-block" name="login" id="log" value="Login">
			</fieldset>
		</form>
	</div>
</div>
<?php }
else { ?>
<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong> You are already logged. Please logout.
</div>

<?php } ?>
<?php } ?>
<?php include 'foot.php';?>