<!DOCTYPE html>
<?php
	session_start();
	require 'Dbconfig/connection.php';
	if (!isset($_SESSION['user'])) 
	{
		echo '<script type="text/javascript">alert("LOGIN FIRST");</script>';
		header('location:index.php');
	}
?>
<html>
<head>
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body style="background-color:#004080">

	<div id="main-wrapper">
		<center>
		<h2>HOME PAGE</h2>
		<?php echo '<img src="'.$_SESSION['image'].'" id="image">'?>
		<h1>WELCOME <?php echo $_SESSION['user'];?></h1>
		</center>

		<form id="form-details" action="homepage.php" method="post">
			<input type="submit" style="background-color: red;" name="logout" value="LOG OUT" id="login-button"><br>
				</form>
	</div>
	<?php
	if(isset($_POST['logout']))
	{
		session_destroy();
		header('location:index.php');

	}
	?>
</body>
</html>