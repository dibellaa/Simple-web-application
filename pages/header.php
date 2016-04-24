<div class="row">
		
	<div class="col-md-12">
	
		<h1>Make the most of it! <i class="fa fa-futbol-o pull-right"></i></h1>
			
	</div>
	<!-- warning if javascript is disabled -->
	<noscript class="col-md-12">
		<div class="alert alert-warning">
    	<strong>Warning!</strong> Javascript is disabled. Website couldn't work in a proper way. Please enable Javascript
		</div>
	</noscript>
		
</div>

<?php
/* update the timeout for the logout */
session_start();

if(isset($_SESSION['auth'])) {
if(!empty($_COOKIE['auth']))
	setcookie('auth', $_SESSION['auth'], time() + (60 * 2), '/', '', true, true); 
}
?>