<html>  
	<head>  
		<title>Login</title> 
	</head>  
	<body>
		<p><a href="formval.php">Register</a> | <a href="login.php">Login</a></p>  
		<h2>Login page</h2> 
		<form action="" method="POST"> 
			<legend>
				<fieldset>
					Email: <input type="text" name="email" value=""><br />  
					Password: <input type="password" name="password" value=""><br /> 
					<input type="submit" value="Log In" name="submit" />  
				</fieldset>	 
			</legend>
		</form>  
<?php  
	session_start();  
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "form";
	$reg = "";
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db( $con, "form");
	$error = "";
	$myname = "";
	$mypassword = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$myemail=mysqli_real_escape_string($con, $_POST['email']);  
			$mypassword=mysqli_real_escape_string($con, $_POST['password']); 
			$sql = "SELECT id from formtable  WHERE email='$myemail' and password='$mypassword'";
			$query = mysqli_query($con, $sql);  
			$num_rows = mysqli_fetch_array ($query,  mysqli_assoc);
			$count = mysqli_num_rows($query);
		if($count > 0)  
			{  
				$_SESSION['login_user'] = $myemail;
				header('location:welcome.php');
			}
	else
		{
			$error = "Invalid email or password";
		}

		}

?>
	</body>
</html>