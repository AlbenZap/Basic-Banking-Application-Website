<!DOCTYPE html>
<html>
<head>
	<title>List</title>

<link rel="stylesheet" type="text/css" href="mystyle.css">

<style type="text/css">
	.myclass
	{
		color: red;
		font-size: 20px;
	}

	#myid
	{
		color: green;
	}
</style>
</head>
<body>
	<h2>An Unordered List</h2>
	<p> Hello <br><hr> World </p>
	<ol>
		<li>
			<ol type="a">
				<li>Nested</li>
				<li>List</li>
			</ol>
		</li>	
		<li id="myid">Two</li>
		<li class="myclass">Three</li>
		<li>Four</li>
		<li>Five</li>
	</ol>
</body>
</html>