<!DOCTYPE HTML> 

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
                    echo "Hello"; die;
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
                    print_r ($query); die;
                    
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
        
 
<html>
    <head>
        <style>
        .error {color: #FF0000;}
        </style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
		<link href="runnable.css" rel="stylesheet" />
    </head>
    <body>
        <h2>form:-</h2>
        <p><span class="error">* required field.</span></p>
            <form method="post" id="form">
                FirstName: <input type="text" id="firstname" name="firstname">
                <span class="error">* <?php echo $firstnameErr;?></span>
				<span id="f_name"></span>
                <br><br>
                LastName: <input type="text" id="lastname" name="lastname">
                <span class="error">* <?php echo $lastnameErr;?></span>
				<span id="l_name"></span>
                <br><br>
                E-mail: <input type="text" id="email" name="email">
                <span class="error">* <?php echo $emailErr;?></span>
				<span id="e_mail"></span>
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
                Password:<input type="text" id="password" name="password">
                <span class="error"><?php echo $passwordErr;?></span>
				<span id="pass_word"></span>
                <br><br>
                Confirm-Password: <input type="text" id="confirm" name="confirm_password">
                <span class="error"><?php echo $confirm_passwordErr;?></span>
                
				<span id="confirm"></span>
                <br><br>
                Gender:
                <input type="radio" checked name="gender" value="female">Female
                <input type="radio" name="gender" value="male">Male
                <span class="error">* <?php echo $genderErr;?></span>
				 <br><br>
				 <button type="submit" id="submit" name="submit"> Submit </button>
				<!--<input type="submit" id="submit" name="submit" value="submit">-->
                <a href="login.php">LOG IN 
                </a>    
            </form>
			
	<script>
		jQuery(document).ready(function()
		{	var flag = 1;
			var firstnamereg = /^[A-Za-z \s]{1,}$/;
			var lastnamereg = /^[A-Za-z \s]{1,}$/;
			var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,20})?$/;
			// var passwordreg = /^[A-Za-z0-9 \s]{1,}$/;
		
			jQuery("form").submit(function()
			{
				var firstname = jQuery("#firstname").val();
				var lastname = jQuery("#lastname").val();
				var email = jQuery("#email").val();
				// var password = jQuery("#password").val();
				// var cpwd = jQuery("#confirm").val();
				firstnamechk(firstname);
				lastnamechk(lastname);
				emailchk(email);
				
				function firstnamechk(temp)
				{
					var templen = temp.length;
					if(templen < 2 || templen > 18)
					{
						jQuery("#f_name").html("name should be 2 to 18 char long");
						jQuery("#f_name").show();
						flag = 0;
					}
					if(!temp.match(firstnamereg))
					{
						jQuery("#f_name").html("name should contain only alphabets and white spaces");
						jQuery("#f_name").show();
						flag = 0;
					}
					if(templen == 0)
					{
						jQuery("#f_name").html("name is required");
						jQuery("#f_name").show();
						flag = 0;
					}
				}
					
				function lastnamechk(temp)
				{	
					var templen = temp.length;
					if(templen < 2 || templen > 18)
					{
						jQuery("#l_name").html("name should be 2 to 18 char long");
						jQuery("#l_name").show();
						flag = 0;
					}
					if(!temp.match(lastnamereg))
					{
						jQuery("#l_name").html("name should contain only alphabets and white spaces");
						jQuery("#l_name").show();
						flag = 0;
					}
					if(templen == 0){
						jQuery("#l_name").html("name is required");
						jQuery("#l_name").show();
						flag = 0;
					}
						
				}
				function emailchk(mail)
				{	
					var templen = mail.length;
					if(!mail.match(emailreg))
					{
						jQuery("#e_mail").html("enter a valid email");
						jQuery("#e_mail").show();
						flag = 0;
					}
					if(templen == 0)
					{
						jQuery("#e_mail").html("email is required");
						jQuery("#e_mail").show();
						flag = 0;
					}
				}
				if(flag == 1){
					jQuery.ajax
					({
						url:"prac1.php",
						type:"POST",
						data: {firstname1:firstname,lastname1:lastname,email1:email} ,
						success: function(response){
								alert(response);
								return;
							}
					});
				}
				else{
					alert ("Fill Details Properly");
				}
				return false;
			});
		});
				
	</script>
    </body>
</html>
