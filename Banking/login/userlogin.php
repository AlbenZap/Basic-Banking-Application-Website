<?php 
session_start();
if($_SESSION['loginstatus']==1)
{

}
else
{
	header('Location:logout.php');
}

include("../reg/dbconfig.php");
$s_email = $_SESSION['email'];
$loginstatus = $_SESSION['loginstatus'];
//to fetch data from table
$balance_query="SELECT * FROM user WHERE email =  '$s_email'";
$balance_run = mysql_query($balance_query,$conn);
$user = mysql_fetch_assoc($balance_run);

//for updating details
if(isset($_POST['updatebtn']))
{
	$u_fname=$_POST['fname'];
	$u_lname=$_POST['lname'];
	$u_password=$_POST['password'];

	$u_query = "UPDATE user SET fname='$u_fname',lname='$u_lname',password='$u_password' WHERE email = '$s_email'";
	$eu = mysql_query($u_query,$conn);
	if($eu)
	{
		?>
		<script type="text/javascript">
			alert("Updated Succesfully");
			window.location="userlogin.php";
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
			alert("Updated Failed");
			window.location="userlogin.php";
		</script>
		<?php
	}

}
// end of update

//payment
if(isset($_POST['paybtn']))
{ 
	//accepting balance
	$to=$_POST['to'];
	$payment_account=$_POST['amount'];
	$mybalance=$user['balance'];
	//fetching balance

	$fq= "SELECT * FROM user WHERE contact= '$to' ";
	$efq= mysql_query($fq,$conn);
	$samnewala= mysql_fetch_assoc($efq);
	$uskabalance= $samnewala['balance'];

	//adding amount to samnewala
	$uskabalance=$uskabalance+$payment_account;

	//updating samnewala ka balance in table
	$balance_query="UPDATE user SET balance='$uskabalance' WHERE contact='$to' ";
	$check=mysql_query($balance_query,$conn);
	if($check)
	{
		?>
		<script type="text/javascript">
			alert("Amount Added!");
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
			alert("Amount NOT Added!");
		</script>
		<?php
	}

//deducting own balance
	$mybalance=$mybalance-$payment_account;

//update mybalance in table
	$balance_query1="UPDATE user SET balance='$mybalance' WHERE email='$s_email' ";
	$check1=mysql_query($balance_query1,$conn);
	if($check1)
	{
		?>
		<script type="text/javascript">
			alert("Amount Deducted!");
			window.location="userlogin.php";
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
			alert("Amount NOT Deducted!");
			window.location="userlogin.php";
		</script>
		<?php
	}	


}
//end of payment

?>
<!DOCTYPE html>
<html>
<head>
	<title>User Account</title>
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
	<nav class="navbar navbar-inverse ">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#buttonid">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="color: white" href="#">Hi <?php echo $user['fname']; ?></a>
			</div>
			<div>
				<div class="collapse navbar-collapse" id="buttonid">
					<ul class="nav navbar-nav navbar-right" style="color: white">
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

<!-- Tabs Starts -->
<div class="container">
  <h2 style="text-align: center;">Your Account</h2>
 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Balance</a></li>
    <li><a data-toggle="tab" href="#menu1">New Payment</a></li>
    <li><a data-toggle="tab" href="#menu2">Update</a></li>
    <li><a data-toggle="tab" href="#menu3">Feedback</a></li>
  </ul>
  
  <div class="tab-content">
	
  	<!-- Balance Section -->
    <div id="home" class="tab-pane fade in active">
      <h3>Your Balance: Rs <?php echo $user['balance']; ?> /-</h3>
    </div>
    <!-- Balance Section Ends -->

    <!-- Payment Section -->
    <div id="menu1" class="tab-pane fade">
   	<form method="POST">
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      	<h3>New Payment</h3>
      		<input type="number" class="form-control" name="to" placeholder="CONTACT NUMBER OF USER TO PAY" required="required"> 
      	</div>	
      </div>

      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="number" min="1" max="<?php echo $user['balance']; ?>" class="form-control" name="amount" placeholder="AMOUNT TO PAY" required="required"> 
      	</div>	
      </div>

      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="submit" class="form-control btn btn-success" value="PAY" name="paybtn"> 
      	</div>	
      </div>
    </form>
    </div>
    <!-- Payment Section Ends -->

    <!-- Update Section -->
    <div id="menu2" class="tab-pane fade">
    <form method="POST">	
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<h3>Update Details</h3>
      		<input type="text" class="form-control" value="<?php echo $user['fname']; ?>" autofocus name="fname" required="required" placeholder="First Name">
      	</div>
      </div>

    <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="text" class="form-control" value="<?php echo $user['lname']; ?>" name="lname" required="required" placeholder="Last Name">      	
      	</div>
    </div>

    <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="password" class="form-control" name="password" required="required" placeholder="Enter Password">
      	</div>
      </div>

    <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="password" class="form-control" name="cpassword" required="required" placeholder="Confirm Password">
      	</div>
      </div>               

    <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="submit" class="form-control btn-danger" value="UPDATE" name="updatebtn" required="required">
      	</div>
      </div>         
    </form>
    </div>

    <!-- Update Section Ends -->

    <!-- Feedback Section -->
    <div id="menu3" class="tab-pane fade">
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<h3>Your Feedback / Queries</h3>
      		<textarea class="form-control" name="feedback" rows="5" style="resize: vertical;" required="required"></textarea>
      	</div>	
      </div>
      <div class="row">
      	<div class="col-sm-8 col-sm-offset-2 form-group">
      		<input type="submit" name="feedbackbtn" class="form-control btn btn-info" value="SUBMIT FEEDBACK">
      	</div>
      </div>
    </div>
    <!-- Feedback Section Ends -->
	
  </div>
</div>
<!-- Tabs Ends -->



</body>
</html> 