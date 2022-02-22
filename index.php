<!DOCTYPE html>


<?php
session_start();
require 'Dbconfig/connection.php';
?>


<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body style="background-color:#004080">

	<div id="main-wrapper">
		<center>
		<h2>LOGIN PAGE</h2>
		<img src="Images/user.png" id="image">
		</center>
		<form id="form-details" action="index.php" method="post">
			<b><label>Username</label></b>
			<input type="text" name="Username" class="input-values" placeholder="enter username" required><br><br>
			<b><label>Password:</label></b>
			<input class="input-values" type="password" name="Password" placeholder="enter Password" required><br>
			<input type="submit" name="login" value="LOG IN" id="login-button"><br>
			<a href="register.php"><input type="button" name="" value="Register" id="register-button"></a>
		</form>
	</div>


	<?php
		if (isset($_POST['login'])) 
		{
			//echo '<script type="text/javascript">alert("Login");</script>';
			$Username=$_POST['Username'];
			$Password=md5($_POST['Password']);
			$query="select * from logininfo where username='$Username' and password='$Password'";
			$query_run=mysqli_query($conn,$query);
			$result=mysqli_fetch_assoc($query_run);
			if (mysqli_num_rows($query_run)>0) 
			{
				$_SESSION['user']=$result['username'];
				$_SESSION['image']=$result['imglink'];
				header('location:homepage.php');
			}
			else
			{
				echo '<script type="text/javascript">alert("Inavlid Credentials");</script>';
			}
		}
	?>
</body>
</html>