<?php include 'head.php'; ?>
<?php if(isset($_COOKIE['set'])) { ?>
<?php
$act = $_REQUEST['activity'];
$act = mysql_real_escape_string($act);

/* code for booking */ 
if(isset($_REQUEST['book'])) {
	$flag = true;
	$con = mysqli_connect("localhost", "s215182", "vairbsir", "s215182")
		or die('Could not connect: ' . mysqli_error($con));

	$query = 'SELECT * FROM reservations WHERE username="' . $_COOKIE['auth'] . '" AND nameA="' . $act . '"';
	$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
	if(mysqli_num_rows($result) != 0) {
		?>
		<div class="alert alert-danger fade in">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Error!</strong> You are already booked for <?php echo $act ?>.
		</div>
		<h3><a href="book.php" class="btn btn-outline btn-danger"> Retry</a></h3>
	<?php
		$flag = false;
	}
	if($flag) {
	$query = 'SELECT freeplace FROM activities WHERE nameA="' . $act . '"';
	$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
	$line = mysqli_fetch_array($result, MYSQL_ASSOC);
	$freeplace = $line['freeplace'];
	$rplace = $_REQUEST['child'] + 1;
	if($rplace > $freeplace) {
	    ?>
		<div class="alert alert-danger fade in">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Error!</strong> There are only <?php echo $freeplace ?> place(s) for <?php echo $act ?>.
		</div>
		<h3><a href="book.php" class="btn btn-outline btn-danger"> Retry</a></h3>
	<?php
		$flag = false;
	}
}

	if($flag) {

	/* start transaction */
	try {
	mysqli_autocommit($con, false);
	$rplace--;
	$query = "INSERT INTO reservations (username, nameA, children) VALUES ('" . $_COOKIE['auth'] . "', '" . $act . "', '" . $rplace . "')";
	$rplace++;
	if(!mysqli_query($con, $query)) {
		throw new Exception("Insert Failed", 1);
	}
	$query = "UPDATE activities SET freeplace=freeplace-" . $rplace . " WHERE nameA='" . $act . "'";
	if(!mysqli_query($con, $query)) {
		throw new Exception("Update Failed", 2);
	}
	mysqli_commit($con);
	?>
<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Your booking has been completed successfully.
</div>
<h3><a href="index.php" class="btn btn-outline btn-danger"> Go to Home</a></h3>
<?php
} catch (Exception $e) {
	mysqli_rollback($con);
	?>
<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> We can't satisfy your request. Please try again.
</div>
<h3><a href="index.php" class="btn btn-outline btn-danger"> Go to Home</a></h3>
<?php
}

}
mysqli_close($con);
}
/* code for removing a reservation */
else if(isset($_REQUEST['canc'])) {
	$canc = $_REQUEST['canc'];
	$canc = mysql_real_escape_string($canc);
	$flag = true;
	$con = mysqli_connect("localhost", "s215182", "vairbsir", "s215182")
		or die('Could not connect: ' . mysqli_error($con));
	$query = 'SELECT * FROM reservations WHERE username="' . $_COOKIE['auth'] . '" AND nameA="' . $canc . '"';
	$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
	if(mysqli_num_rows($result) == 0) {
		?>
		<div class="alert alert-danger fade in">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Error!</strong> The reservation for <?php echo $canc ?> is already canceled.
		</div>
		<h3><a href="profile.php" class="btn btn-outline btn-danger"> Profile</a></h3>
	<?php
		$flag = false;
	}
	if($flag) {
	$line = mysqli_fetch_array($result, MYSQL_ASSOC);
	$dplace = $line['children'];
	$dplace++;

	/* start transaction */
	try {
	mysqli_autocommit($con, false);

	$query="DELETE FROM reservations WHERE username='" . $_COOKIE['auth'] . "' AND nameA='" . $canc . "'";
	if(!mysqli_query($con, $query)) {
		throw new Exception("Delete failed", 1);
	}
	$query = "UPDATE activities SET freeplace=freeplace+" . $dplace . " WHERE nameA='" . $canc . "'";
	if(!mysqli_query($con, $query)) {
		throw new Exception("Update failed", 2);
	}
	mysqli_commit($con);
	?>
	<script type="text/javascript">
		window.location.href = 'profile.php'
	</script>
	<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Your booking has been canceled successfully.
	</div>
	<h3><a href="profile.php" class="btn btn-outline btn-danger"> Profile</a></h3>
<?php
} catch (Exception $e) {
	mysqli_rollback($con);
	?>
<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> We can't satisfy your request. Please try again.
</div>
<h3><a href="index.php" class="btn btn-outline btn-danger"> Go to Home</a></h3>
<?php
}

}
mysqli_close($con);
}	
?>
<?php } ?>
<?php include 'foot.php' ?>