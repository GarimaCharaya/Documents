<html>
	<head>
		<style>
		<p style="color:red;">
		<?php echo $_SESSION['msg1'];?>
		<?php echo $_SESSION['msg1']="";?>
		</p>
		</style>
	<body>
		<form name="chngpwd" action="" method="post" onSubmit="return valid();">
			<table align="center">
				<center><p> Change Password <p><center>
				<tr height="50">
					<td>Old Password :</td>
					<td><input type="text" name="opwd" id="opwd"></td>
				</tr>
				<tr height="50">
					<td>New Passowrd :</td>
					<td><input type="text" name="npwd" id="npwd"></td>
				</tr>
				<tr>
					<td><a href="welcome.php">Back to Account</a></td>
					<td><input type="submit" name="submit" value="Submit" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "form";
	$con = mysqli_connect($servername,$username,$password,$dbname);
	mysqli_select_db( $con, "form");
	if(isset($_POST['submit']))
	{
		$sql = "SELECT password FROM formtable where password='".$_POST['opwd']."' && email='".$_SESSION['login_user']."'";
		$result = mysqli_query($con, $sql);
		$num = mysqli_num_rows ($result);
		//echo $num; die;
		if($num > 0)
		{
			$sql1 = "update formtable set password='".$_POST['npwd']."' where email='".$_SESSION['login_user']."'";
			//print_r ($sql1); die;
			$query = mysqli_query($con, $sql1);
			$_SESSION['msg1'] = "Password Changed Successfully !!";
		}
	else
	{
		$_SESSION['msg1']="Old Password not match !!";
	}
	}
?>
