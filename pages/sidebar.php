<?php if(isset($_COOKIE['set'])) { ?>
<div class="col-xs-6 col-sm-4 col-md-3 sidebar-offcanvas">
	<?php 
	if(isset($_SESSION['auth'])){
	$auth = (!empty($_COOKIE['auth']))
    && ($_COOKIE['auth'] === $_SESSION['auth']);
    }
    else $auth=false; 
    ?>
	<ul data-spy="affix" data-offset-top="120" id="affix" class="nav nav-stacked">
		<li> <a href="index.php"> <i class="fa fa-th"></i> Home</a></li>
		<?php if(!$auth) { ?>
			<li><a href="#" data-toggle="collapse" data-target="#sub1" class="collapsed"> <i class="fa fa-user"></i>Log In <span class="fa arrow"></span></a>
			<ul class="nav collapse" id="sub1">
			<li><a href="signup.php"><i class="fa fa-user-plus"></i> Sign Up</a></li>
			<li><a href="https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/login.php"><i class="fa fa-sign-in"></i> Log In</a></li>
		<?php 
		 }
		 else { ?>
		 	<li><a href="#" data-toggle="collapse" data-target="#sub1" class="collapsed"> <i class="fa fa-user"></i><?php  print($_COOKIE['auth']) ?> <span class="fa arrow"></span></a>
		 	<ul class="nav collapse" id="sub1">
		 		<li><a href="profile.php"><i class="fa fa-home"></i> Profile</a></li>
				<li><a href="book.php"><i class="fa fa-pencil-square-o"></i> Book Now</a></li>
			    <li><a href="auth.php?logout=true" id="logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
			   <?php
			    } ?>
			</ul>
		</li>
	</ul>
</div>
<!-- if javascript is disabled and bootstrap is enabled, I add this button because the dropdown menu doesn't work -->
<noscript>
		<div class="noscript">
		<?php if(!$auth) { ?>
			<div><a class="btn btn-outline btn-default" href="signup.php"><i class="fa fa-user-plus"></i> Sign Up</a></div>
			<div><a class="btn btn-outline btn-default" href="https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])?>/login.php"><i class="fa fa-sign-in"></i> Log In</a></div>
		<?php 
		 }
		 else { ?>
		 	<div><a class="btn btn-outline btn-default" href="profile.php"><i class="fa fa-home"></i> Profile</a></div>
			<div><a class="btn btn-outline btn-default" href="book.php"><i class="fa fa-pencil-square-o"></i> Book Now</a></div>
			<div><a class="btn btn-outline btn-default" href="auth.php?logout=true" id="logout"><i class="fa fa-sign-out"></i> Log Out</a></div>
			<?php
			} ?>
	</div>
</noscript>
<?php } ?>