<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Alessandro Di Bella">

<title>FreeTime - Make the most of it!</title>

<script src="../js/jquery.js"></script> <!-- jQuery -->

    <!-- Bootstrap and icons libraries-->
<!-- comment this three lines to disable third part libraries -->
<link href="../css/bootstrap.css" rel="stylesheet">
<script src="../js/bootstrap.js"></script>
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
<link href="../css/navbar-static-top.css" rel="stylesheet">
<!-- if Bootstrap is disabled decomment this style -->
<!-- <link href="../css/mystyle.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>

	<!-- top navbar -->
    <?php include 'navbar.php'; ?>
    <!-- check cookie -->
    <?php if(!isset($_COOKIE['set'])) { ?>
        <div class="alert alert-danger">
            <strong>Error!</strong> Cookies are disabled. You can't visit the website. Please enable Cookie.
        </div>
    <?php
    } 
    ?> 
    <div id="container" class="container">

    	<?php include 'header.php'; ?>
		
		<div id="content" class="row">
		
			<!-- sidebar -->
			<?php include 'sidebar.php'; ?>
			
			<!-- content -->
			<div class="col-xs-12  col-sm-8 col-md-9 content">