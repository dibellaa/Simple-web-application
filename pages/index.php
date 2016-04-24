<?php include 'head.php';?>
<?php if(isset($_COOKIE['set'])) { ?>			
<?php
/* if the user is logged $auth is true */
if(isset($_SESSION['auth'])){
	$auth = (!empty($_COOKIE['auth']))
    && ($_COOKIE['auth'] === $_SESSION['auth']);
    }
else $auth=false; 
$con = mysqli_connect("localhost", "s215182", "vairbsir", "s215182")
		or die('Could not connect: ' . mysqli_error($con));

$query = 'SELECT * FROM activities ORDER BY freeplace DESC';
$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));

while($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	echo '<div class="col-lg-6 col-md-6">
    		<div class="panel panel-grey">
    		<div class="panel-heading">
			<div class="row">
            <div class="col-xs-3 text-left">';
	echo "<h2>" . $line['nameA'] . "</h2></div>";
	echo "<div class='col-xs-9 text-right'>";
	echo "<div class='huge'>" . $line['freeplace'] . "</div>";
	echo "<div> Out of " . $line['place'] . " places</div>";
	echo '</div></div></div>'; 
	if($auth && $line['freeplace'] > 0) {
	?>
	<div class="panel-footer clearfix">
			<div class="pull-right">
			<a href="book.php?activity=<?php echo $line['nameA'] ?>" class="btn btn-primary">
				Book!
			</a>
			</div>
		</div>
	<?php
	}
	echo "</div></div>";
}
mysqli_close($con);
?>
<?php } ?>
<?php include 'foot.php';?>