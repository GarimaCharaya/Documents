
<?php
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "form";
	$reg = "";
	$con = mysqli_connect($servername,$username,$password,$dbname);
	mysqli_select_db( $con, "form");
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysqli_query ($con, "select * from formtable where id='$user_check'");
	$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
	$login_email = $row['id'];
	if(!isset($_SESSION['login_user'])) 
	{
		header("location:login.php");
	}
?>