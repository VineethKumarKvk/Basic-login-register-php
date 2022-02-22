<!DOCTYPE html>

<?php
require 'Dbconfig/connection.php';
?>
<html>
<head>
	<title>Register Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body style="background-color:#004080">

	<div id="main-wrapper">
		<center>
		<h2>REGISTER</h2>
		<img src="Images/user.png" id="image">
		</center>
		<form id="form-details" action="register.php" method="post" accept=".JPG,.jpg,.jpeg,.gif,.png"  enctype="multipart/form-data">
			<b><label>Profile Pic</label></b>
			<center></center><input type="file" name="imglink"></center><br><br>
			<b><label>Full Name</label></b><br>
			<input type="text" name="fullname" class="input-values" placeholder="Enter Fullname"><br><br>
			<b><label>Gender</label></b>
			<input type="radio" name="gender" value="Male" required checked>Male
			<input type="radio" name="gender" value="Female" required>Female<br><br>
			<b><label>Branch</label></b>
			<select name="Branch" required>
				<option value="CSE" selected>CSE</option>
				<option value="ECE">ECE</option>
				<option value="EEE">EEE</option>
				<option value="MECH">MECH</option>
				<option value="CIVIL">CIVIL</option>
			</select><br><br>
			<b><label>Username</label></b>
			<input type="text" name="username" class="input-values" placeholder="enter username" required><br><br>
			<b><label>Password</label></b>
			<input class="input-values" type="password" name="password" placeholder="enter Password" required><br><br>
			<b><label>Confirm Password</label></b>
			<input class="input-values" type="password" name="cpassword" placeholder="Re-Enter Password" required><br>
			<input type="submit" name="register" value="Register" id="login-button"><br>
			<a href="index.php"><input type="button" name="" value="<<  Back to login" id="backtologin-button"></a>
		</form>
	</div>

	<?php
		if (isset($_POST['register']))
		{
			//echo '<script type="text/javascript">alert("Clicked");</script>';
			$fullname=$_POST['fullname'];
			$gender=$_POST['gender'];
			$branch=$_POST['Branch'];
			$password=$_POST['password'];
			$cpassword=$_POST['cpassword'];
			$username=$_POST['username'];

			$imagename=$_FILES['imglink']['name'];
			$imagesize=$_FILES['imglink']['size'];
			//print_r($_FILES['imglink']);
			$imagetempname=$_FILES['imglink']['tmp_name'];
			$directory='Uploads/Images/';
			$image_file=$directory.$imagename;
			//echo "$image_file";
			if($password==$cpassword)
			{
				$query="select * from logininfo where username='$username'";
				$query_run=mysqli_query($conn,$query);
				if(mysqli_num_rows($query_run)>0)
				{
					echo '<script type="text/javascript">alert("Username Alredy exist");</script>';
				}
				else if ($imagesize>2097152)
				 {
					echo '<script type="text/javascript">alert("File too big upload less than 2MB");</script>';
				}
				else if(file_exists($image_file))
				{
					echo '<script type="text/javascript">alert("Image Alredy exist");</script>';
				}

				else
				{
					$encrypted_password=md5($password);  //For Security (HASHING)
					move_uploaded_file($imagetempname,$image_file);
					$query="insert into logininfo values('$fullname','$branch','$gender','$username','$encrypted_password','$image_file')";
					$query_run=mysqli_query($conn,$query);
					if($query_run)
					{
						echo '<script type="text/javascript">alert("Registered Succesfully Go to login page to login.........");</script>';
					}
					else
					{
						echo '<script type="text/javascript">alert("Error");</script>';
					}

				}
				

			}
			else
				echo '<script type="text/javascript">alert("Password not matched");</script>';
		}

	?>

</body>
</html>