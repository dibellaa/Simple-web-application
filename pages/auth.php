<?php include 'head.php'; ?>
<!-- if the 'set' COOKIE is not setted means that cookies are disabled -> don't load page -->
<?php if(isset($_COOKIE['set'])) { ?>
	<?php
	/* code for login */
	if(isset($_REQUEST['login'])) {
  	
  	session_regenerate_id(true);
  	$flag = true;
	$con = mysqli_connect("localhost", "s215182", "vairbsir", "s215182")
		or die('Could not connect: ' . mysqli_error($con));
	$user = $_REQUEST['user'];
	$user = mysql_real_escape_string($user);
	$query = 'SELECT * FROM users WHERE username="' . $user . '"';
	$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
	if(mysqli_num_rows($result) == 0) {
		?>
		<div class="alert alert-danger fade in">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Error!</strong> Username doesn't exist.
		</div>
		<h3><a href="login.php" class="btn btn-outline btn-danger"> Retry</a></h3>
	<?php
		$flag = false;
	}
	if($flag) {
	$user = $_REQUEST['user'];
	$user = mysql_real_escape_string($user);
	$query = 'SELECT password FROM users WHERE username="' . $user . '"';
	$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
	$line = mysqli_fetch_array($result, MYSQL_ASSOC);
	if(md5($_REQUEST['password']) != $line['password']) {
		?>
		<div class="alert alert-danger fade in">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Error!</strong> Invalid password for <?php echo $_REQUEST['user'] ?>.
		</div>
		<h3><a href="login.php" class="btn btn-outline btn-danger"> Retry</a></h3>
	<?php
		$flag = false;
	}
}
/* set COOKIE and SESSION only if flag is true -> all operations above are successfully */
	if($flag) {
	$_SESSION['auth'] = $_REQUEST['user'];
	// create authentication cookie, and restrict it to HTTPS pages
	setcookie('auth', $_REQUEST['user'], time() + (60 * 2), '/', '', true, true);
	?>

	<script type="text/javascript">
		window.location.href = 'https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/index.php'
	</script>

	<h3><a href="https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/index.php" class="btn btn-outline btn-danger"> Go to Home</a></h3>
<?php
}
mysqli_close($con);
}
/* code for signig up to website */
else if(isset($_REQUEST['reg'])) {
	$flag = true;
	$con = mysqli_connect("localhost", "s215182", "vairbsir", "s215182")
		or die('Could not connect: ' . mysqli_error($con));
	$user = $_REQUEST['user'];
	$user = mysql_real_escape_string($user);
	$query = "SELECT * FROM users WHERE username='" . $user . "'";
	$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
	if(mysqli_num_rows($result) != 0) {
		?>
		<div class="alert alert-warning">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Warning!</strong> The username <?php echo $_REQUEST['user']; ?> is already used.
		</div>
		<h3><a href="signup.php" class="btn btn-outline btn-danger"> Retry</a></h3>
	<?php
		$flag = false;
	}
	if($flag){
		$user = $_REQUEST['user'];
		$user = mysql_real_escape_string($user);
		$query = "INSERT INTO users (username, password) VALUES ('" . $user . "', MD5('" . $_REQUEST['password'] . "'))";
		$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
		?>
		<div class="alert alert-success fade in">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Success!</strong> Your registration has been completed successfully. Now you can login.
		</div>

		<h3><a href="http://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/login.php" class="btn btn-outline btn-danger"> Login</a></h3>
<?php
	}
	mysqli_close($con);
}
/* code for logout */
else if(isset($_REQUEST['logout'])) {
	session_unset();
	session_destroy();
	setcookie('auth', 0, time() - (60 * 2), '/', '', true, true);
	?>
	<script type="text/javascript">
		window.location.href = 'http://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/index.php'
	</script>

	<h3><a href="http://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/index.php" class="btn btn-outline btn-danger"> Go to Home</a></h3>
<?php
}
?>
<?php } ?>	
<?php include 'foot.php'; ?>