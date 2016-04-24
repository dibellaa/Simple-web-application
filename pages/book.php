<?php include 'head.php' ?>
<?php if(isset($_COOKIE['set'])) { ?>
<?php
/* if the user is logged $auth is true */
if(isset($_SESSION['auth'])) {
$auth = (!empty($_COOKIE['auth'])) && ($_COOKIE['auth'] === $_SESSION['auth']);
}
else
	$auth = false;
if(!$auth) { ?>
	<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong> You must be logged to booking.
	</div>
	<h3><a href="https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/login.php" class="btn btn-outline btn-danger"> Login</a></h3>
<?php
}
else { 
	$con = mysqli_connect("localhost", "s215182", "vairbsir", "s215182")
		or die('Could not connect: ' . mysqli_error($con));

	$query = 'SELECT * FROM activities ORDER BY freeplace DESC';
	$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
	?>
	<div class="col-lg-6 panel">
	<div class="panel-heading">
		<h2 class="panel-title">Make your Reservation</h2>
	</div>
	<div class="panel-body">
		<form role="form" id="flog" method="post" action="bookmng.php">
			<fieldset>
				<div class="form-group">
					<label for="activity">Select an activity</label>
					<select class="form-control" name="activity" id="activity" required>
				<?php
				if(isset($_GET['activity']))
					echo "<option value='" . $_GET['activity'] . "'>" . $_GET['activity'] . "</option>";
				else { 
					while($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
						if($line['freeplace'] > 0) {
							echo "<option value='" . $line['nameA'] . "'>" . $line['nameA'] . "</option>";
						}
					}
				}
					mysqli_close($con);
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="child"> How many children? (max 3)</label>
                    <input class="form-control" id="child" name="child" type="number" value="0" min="0" max="3" required>
                </div>
                    <input type="submit" class="btn btn-lg btn-primary btn-block" name="book" id="book" value="Book It!">
			</fieldset>
		</form>
	</div>
</div>
<?php
}
?>
<?php } ?>
<?php include 'foot.php'; ?>