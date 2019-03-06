<?php 
$server = "localhost";
$user = "ReyKiptoo";
$pass = "adminp@ss";
$db = "logreg";

$conn = mysqli_connect($server, $user, $pass, $db);
if (!$conn) {
	die("Connection Failed" . mysqli_connect_error());
}
 {
	echo "<h3>Successful Connection</h3>";
}


 ?>