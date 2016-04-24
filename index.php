<!DOCTYPE html>
<html>
<head>
<!-- set cookie and then check if exist -->
<?php 
if(!isset($_COOKIE['set'])) {
setcookie('set', 'true');
} ?>
<meta http-equiv="refresh" content="0;url=pages/index.php">
<title>FreeTime - Make the most of it!</title>
<script language="javascript">
    window.location.href = "pages/index.php"
</script>
</head>
<body>
Go to <a href="pages/index.php">/pages/index.php</a>
</body>
</html>