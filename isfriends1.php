<?php
ob_start();
//include 'check.php';
session_start();
//echo "4";
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
//echo "1hahahah";
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
	die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
 }
//echo "1hahahah";
$username=$_SESSION['username'];
$target=$_POST["target"];


if(empty($_POST["target"])) {
	header("refresh:2;url=http://localhost/isfriends2.php");
	echo "Please fill the blank.";
	exit(0);
} else {
	$targets = "SELECT accounts.username FROM accounts WHERE accounts.username = '$target'";
    $exist = $mysqli->query($targets);
    if ($exist->num_rows == 1) {
    	$checking = "SELECT * FROM isfriends WHERE isfriends.target = '$target' AND isfriends.user = '$username'";
        $check = $mysqli->query($checking);
        if($check->num_rows > 0) {
        	header("refresh:2;url=http://localhost/isfriends2.php");
        	echo "The user already exists in your favourite list. Please add another user.";
        } else {
	    	$sql = "INSERT INTO isfriends (user, target) VALUES ('$username', '$target')";
			$result = $mysqli->query($sql);
			if($result === TRUE) {
				header("refresh:2;url=http://localhost/loggedin.php");
			 	echo "<br>Following successfully.<br>";
			} else {
			    echo "Error: " . $sql0 . "<br>" . $result0->error;
			}
		}
	} else {
			header("refresh:2;url=http://localhost/isfriends2.php");
			echo "There is no user based on your input.";
			exit(0);
	}
}
$mysqli->close();

?>