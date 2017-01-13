<?php
ob_start();
session_start();
?>

<style>
html{
    background-color: #f2f2f2;
}
</style>

<?php

DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'aza');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_DATABASE', 'PROJECT');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
	die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
 }

$username=$_POST["username"];
$password=$_POST["password"];
$iterations = 1000;

if(empty($_POST["username"])|| empty($_POST["password"])){
	header("refresh:2;url=http://localhost/addaccount2.php");
	echo "Please fill the blank.";
	exit(0);
} else {
	$accountName = "SELECT accounts.username FROM accounts WHERE accounts.username = '$username'";
    $exist = $mysqli->query($accountName);
    if ($exist->num_rows > 0) {
    	header("refresh:2;url=http://localhost/addaccount2.php");
    	echo "Sorry, username already exists. Please try another one.";
    	echo "Do you want to go back to the home page?";
    	
    } else {
    	// INSERT CONTENT INTO DATABASE
    	$salt = "~!@#$%^&*()_+";
    	$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 64);
		 $sql = "INSERT INTO accounts (username, password) VALUES ('$username', '$hash')";
		 $result = $mysqli->query($sql);
		 if($result === TRUE) {
		 	header("refresh:2;url=http://localhost/loggedin.php");
		 	echo "<br>New account created successfully.<br>";

		} else {
		    echo "Error: " . $sql0 . "<br>" . $result0->error;
		}
    }
}
$mysqli->close();
?>