<?php
include("dbconfig.php");
$flag=0;
	if(isset($_POST['submit']))
	{
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$contact=$_POST['contact'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
		$balance=5000;

		//comparing password
        if($password!=$cpassword)
        {
        	$flag=1;
        	?>
        	<script type="text/javascript">
        		alert("Passwords DO NOT match!");
        		window.location="../reg/"
        	</script>
        	<?php
        }

        //email validation	
		$ev = "SELECT * FROM user WHERE email = '$email'";
		$eq = mysql_query($ev,$conn);
		$e_count = mysql_num_rows($eq);
		if($e_count>0)
		{
			$flag=1;
			?>
        	<script type="text/javascript">
        		alert("Email already exists");
        		window.location="../reg/"
        	</script>
        	<?php
		}

		//contact validation	
		$ec = "SELECT * FROM user WHERE contact = '$contact'";
		$ecq = mysql_query($ec,$conn);
		$e_count = mysql_num_rows($ecq);
		if($e_count>0)
		{
			$flag=1;
			?>
        	<script type="text/javascript">
        		alert("Contact already exists");
        		window.location="../reg/"
        	</script>
        	<?php
		}


		$q= "INSERT INTO user(fname,lname,email,contact,password,balance) VALUES('$fname','$lname','$email','$contact','$password','$balance')";

		if($flag==0)
		{
			$iq= mysql_query($q,$conn);
		}

		
		

		if($iq)
		{
			?>
			<script type="text/javascript">
				alert("Registered!");
				window.location="../";
			</script>
		    <?php
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Failed!");
				window.location="../reg/";
			</script>
		    <?php
		}

	}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<!-- Meta encoding -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- BOOTSTRAP CDN -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- BOOTSTRAP CDN END -->

	<!-- icon code -->
	<link rel="icon" type="image/jpeg" href="">

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top ">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#buttonid">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="color: white" href="#">Banking</a>
			</div>
			<div>
				<div class="collapse navbar-collapse" id="buttonid">
					<ul class="nav navbar-nav navbar-right" style="color: white">
						<li><a href="../">Home</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<!-- Registration Form -->
	<div class="container-fluid" style="padding-top: 5%">
		<h2 style="text-align: center;">Register for Scam Bank</h2>
		<form method="POST">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-group">
					<input type="text" name="fname" class="form-control" required="required" placeholder="First Name Here">
				</div>
			</div>
			<!-- Row Ends -->

			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-group">
					<input type="text" name="lname" class="form-control" required="required" placeholder="Last Name Here">
				</div>
			</div>
			<!-- Row Ends -->

			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-group">
					<input type="email" name="email" class="form-control" required="required" placeholder="Enter Email ID">
				</div>
			</div>
			<!-- Row Ends -->

			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-group">
					<input type="number" name="contact" class="form-control" required="required" placeholder="Enter Mobile Number">
				</div>
			</div>
			<!-- Row Ends -->

			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-group">
					<input type="password" name="password" class="form-control" required="required" placeholder="Enter Password">
				</div>
			</div>
			<!-- Row Ends -->

			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-group">
					<input type="password" name="cpassword" class="form-control" required="required" placeholder="Confirm Password">
				</div>
			</div>
			<!-- Row Ends -->

			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 form-group">
					<input type="submit" name="submit" class="btn btn-primary form-control" >
				</div>
			</div>
			<!-- Row Ends -->

		</form>
		
	</div>

</body>
</html> 