
<?php
	include('session.php');
	echo "Email=".$user_check."<br><br>";
?>
<html>
	<head>
		<style>	
			#t
				{
				text-decoration : none;
				}
		</style>
	</head>
	<body>
		<button><a href="changepassword.php" id="t" >Change Password</a></button><br><br>
		<button><a href="logout.php" id="t" >Logout</a></button>
	</body>
</html>