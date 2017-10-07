<!DOCTYPE HTML>  
<html>
    <head>
        <style>
        .error {color: #FF0000;}
        </style>
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
		<link href="runnable.css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- jQuery Form Validation code -->
	<script>
		$(document).ready(function()
		{ 
			jQuery("form").submit(function()
			{
				var firstname = jQuery("#firstname").val();
				var lastname = jQuery("#lastname").val();
				var email = jQuery("#email").val();
				var password = jQuery("#password").val();
				var confirm= jQuery("#confirm").val();
				
				
				namechk(firstname);
				
				
				function namechk(temp)
				{
					var templen = temp.length;
					if(templen < 2 || templen > 18)
					{
						jQuery("#f_name").html("name should be 2 to 18 char long");
						jQuery("#f_name").show();
						
					}
				
					if(templen == 0)
					{
						jQuery("#f_name").html("fill the column");
						jQuery("#f_name").show();
						
					}
}
return false;
			});

			
		});
			
			
	</script>
    </head>
    <body>  

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form";
        $reg = "";
        $con = mysqli_connect($servername,$username,$password,$dbname);
		
        $firstnameErr = $lastnameErr = $emailErr = $dobErr = $genderErr = $passwordErr = $confirm_passwordErr = $dayErr = $mErr = $yErr=  "";
        $firstname = $lastname = $email = $dob = $gender = $password = $confirm_password = $day= $m=$y=$a= $firstnamelen="";
        
        if (isset($_POST['submit']))
        {
            $firstnamelen = strlen($_POST['firstname']);
            $lastnamelen = strlen($_POST['lastname']);
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                
                if (empty($_POST["firstname"])) 
                {
                    $firstnameErr = "required";
                }
                
                if (empty($_POST["lastname"])) 
                {
                    $lastnameErr = "required";
                }
                             
                if (empty($_POST["email"]))
                {
                    $emailErr = "required";
                }            
                if (empty($_POST["gender"]))
                {
                    $genderErr = "Gender is required";
                }
                if (empty($_POST["day"]))
                {
                    $dayErr = "required";
                }
                if (empty($_POST["month"]))
                {
                    $mErr = "required";
                }
                if (empty($_POST["year"]))
                {
                    $yErr = "required";
                }
                if (empty($_POST["password"]))
                {
                    $passwordErr = " required";
                }                 
                if (empty($_POST["confirm_password"])) 
                {
                    $confirm_passwordErr = "Enter Password";
                }
                if ($_POST['password'] != $_POST['confirm_password']){
                    $confirm_passwordErr = "Password not match";
                }
                else 
                {
                    //echo "Hello"; die;
                     $firstname = test_input($_POST["firstname"]);
                    $confirm_password = test_input($_POST["confirm_password"]);
                    $password = test_input($_POST["password"]);
                    $gender = test_input($_POST["gender"]);
                     $day = test_input($_POST["day"]);
                    $m= test_input($_POST["month"]);
                     $y = test_input($_POST["year"]);
                    $email = test_input($_POST["email"]);
                    $lastname = test_input($_POST["lastname"]);
                     $dob=$day."/".$m."/".$y;            
                    $query = "INSERT INTO formtable(firstname,lastname,email,password,confirm_password,gender, dob) VALUES('$firstname','$lastname',
                    '$email','$password','$confirm_password','$gender','$dob')";
                    // print_r ($query); die;
                    
                    $data= mysqli_query($con,$query);
                }
            }
        }            
        function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }            
    ?>
        

        <h2>form:-</h2>
        <p><span class="error">* required field.</span></p>
            <form method="post" action=" ">
                FirstName: <input type="text" id="firstname" name="firstname">
                <span class="error">* <?php echo $firstnameErr;?></span>
				<span id="f_name"></span>
                <br><br>
                LastName: <input type="text" name="lastname">
                <span class="error">* <?php echo $lastnameErr;?></span>
				<span id="lastname"></span>
                <br><br>
                E-mail: <input type="text" name="email">
                <span class="error">* <?php echo $emailErr;?></span>
				<span id="email"></span>
                <br><br>
                DOB:
				<select name= "day">
				<?php
				for($j=01 ;$j<=31;$j++)
				{
					echo "<option value=".$j.">".$j."</option>";
				}
				?>
				<option name="day"></option>
				</select>
				<select name= "month">
				<?php
				for($i=01 ;$i<=12;$i++)
				{
					echo "<option value=".$i.">".$i."</option>";
				}
				?><option name="month"></option>
				</select>
				<select name= "year">
				<?php
				for($k=1984 ;$k<=2017;$k++)
				{
					echo "<option value=".$k.">".$k."</option>";
				}
				?><option name="year"></option>
				</select>	<br><br>			
                Password:<input type="text" name="password">
                <span class="error"><?php echo $passwordErr;?></span>
				<span id="password"></span>
                <br><br>
                Confirm-Password: <input type="text" name="confirm_password">
                <span class="error"><?php echo $confirm_passwordErr;?></span>
                <span class="error"><?php echo $a;?></span>
				<span id="confirm"></span>
                <br><br>
                Gender:
                <input type="radio" checked name="gender" value="female">Female
                <input type="radio" name="gender" value="male">Male
                <span class="error">* <?php echo $genderErr;?></span>
				 <br><br>
				<input type="submit" id="submit" name="submit" value="submit">
                <a href="login.php">LOG IN 
                </a>    
            </form>
    </body>
</html>
