<?php include 'head.php' ?>
<?php if(isset($_COOKIE['set'])) { ?>
<?php

if(isset($_SESSION['auth'])){
	$auth = (!empty($_COOKIE['auth'])) && ($_COOKIE['auth'] === $_SESSION['auth']);
}
else 
    $auth=false;
if($auth) {
$con = mysqli_connect("localhost", "s215182", "vairbsir", "s215182")
		or die('Could not connect: ' . mysqli_error($con));

$query = 'SELECT * FROM reservations WHERE username="' . $_COOKIE['auth'] . '"';
$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
if(mysqli_num_rows($result) == 0) { ?>
<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong> You are not booked to any activities.
</div>
<h3><a href="https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/book.php" class="btn btn-outline btn-danger"> Book Now!</a></h3>
<?php
}
else {
?>
<?php
while($line = mysqli_fetch_array($result, MYSQL_ASSOC)) { ?>
<div class="col-lg-6 col-md-6">
	<div class="panel panel-grey">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3 text-left">
					<h2> <?php echo $line['nameA'] ?></h2>
				</div>
				<div class="col-xs-offset-8 text-rigt">
					<div> <h3>Booked</h3></div>
					<div>With <?php echo $line['children'] ?> children</div>
				</div>
			</div>
		</div>
		<div class="panel-footer clearfix">
			<div class="pull-right">
			<a href="bookmng.php?canc=<?php echo $line['nameA'] ?>" class="btn btn-primary">
				Cancel
			</a>
			</div>
		</div>
	</div>
</div>
<?php
}
}
}
else { ?>
<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong> You must be logged.
</div>
<h3><a href="https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/login.php" class="btn btn-outline btn-danger"> Login</a></h3>
<?php
}
?>
<?php } ?>
<?php include 'foot.php'; ?>