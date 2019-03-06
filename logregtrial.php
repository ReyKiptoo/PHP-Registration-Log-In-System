<?php
require 'includes/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>LogIn/Registration Form</title>
	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
		.bg {
			min-height: 300px;
			background-image: url('images/6.jpg');
		}
		.bg h1 {
			color: rgb(16, 225, 203);
			font-size: 4em;
			font-weight: bold;
		}
		.bg h5 {
			font-style: italic;
			color: rgb(205, 236, 10);
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="jumbotron bg text-center">
			<h1>Simple LogIn and Register System</h1>
			<h5>Using Session Variables to remember state</h5>
		</div>
	</div>

	<!-- start from w3-->

	<ul class="nav nav-pills">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="pill" href="#login">Log In</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="pill" href="#register">Register</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active container" id="login">
			<div id="login">
				<div class="row">
					<div class="col-3"></div>
					<div class="col-6">
						<form action="logregtrial.php" method="post">
							<legend class="text-center">Log In</legend>
							<div class="form-group">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" id="email" name="mail" required>
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="pwd" name="pass" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block" name="login">Log In</button>
						</form>
					</div>
					<div class="col-3"></div>
				</div>
			</div>
		</div>
		<br><br><br>
		<div class="tab-pane container" id="register">
			<div id="register">
				<div class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<form action="logregtrial.php" method="post">
							<legend class="text-center">Register</legend>
							<div class="form-group">
								<label for="name">Name:</label>
								<input type="text" class="form-control" name="name" id="register" required>
								<label for="email">Email address:</label>
								<input type="email" class="form-control" name="mail" id="email" required>
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="pwd" name="pass" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
						</form>
					</div>
					<div class="col-2"></div>
				</div>
			</div>
			<br><br><br><br><br><br>
		</div>
	</div>
		<!-- end from w3 -->
</body>
<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</html>
<?php 
// Check if user is logged in 
if (isset($_POST['login'])) {
	extract($_POST);
	$query = "SELECT * FROM users WHERE email = '$mail' AND password = '$pass'";
	$result = mysqli_query($conn, $query);

	//Check for query error
	if (!$result) {
		die("Query Failed" . mysqli_error($conn));
	}
	$count = mysqli_num_rows($result);
	// check if email and password matched
	if ($count == 1) {
		//Successful LogIn
		echo "<h2>Log In Success</h2>";
		header("location: dashboard.php");
	}
	else {
		echo "<h2>Username or Password entered is Incorrect</h2>";
	}



}

elseif (isset($_POST['register'])) {
	// getting user input
	extract($_POST);
	$encryptedPass = md5($pass);
	// persist/save user input to db
$query = "INSERT INTO users(name, email, password) VALUES ('$name', '$mail', '$pass')";
if (mysqli_query($conn, $query)) {
	//insert success
	echo "<h1>Register Success</h1>";
	// reload
	header("location: logregtrial.php");
}
else {
	die("Insert Error" . mysqli_error($conn));
}



}
 ?>
