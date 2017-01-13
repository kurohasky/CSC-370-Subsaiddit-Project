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
//echo "1hahahah";
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
	die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
 }
//echo "1hahahah";
$username=$_SESSION['username'];
$subscriptions=$_POST["subscriptions"];

if(empty($_POST["subscriptions"])) {
	header("refresh:2;url=http://localhost/subscriptions2.php");
	echo "Please fill the blank.";
	exit(0);
} else {
	$subsaiddit = "SELECT * FROM subsaiddit WHERE subsaiddit.title = '$subscriptions'";
    $exist = $mysqli->query($subsaiddit);
    if ($exist->num_rows == 1) {
    	$checking = "SELECT * FROM subscriptions WHERE subscriptions.Subsaiddit = '$subscriptions' AND subscriptions.user = '$username'";
        $check = $mysqli->query($checking);
        if($check->num_rows > 0) {
        	header("refresh:2;url=http://localhost/subscriptions2.php");
        	echo "The subsaiddit already exists in your subscriopnts list. Please add another subsaiddit.";
        } else {
	    	$sql = "INSERT INTO subscriptions(user, Subsaiddit) VALUES ('$username', '$subscriptions')";
			$result = $mysqli->query($sql);
			if($result === TRUE) {
				header("refresh:2;url=http://localhost/loggedin.php");
			 	echo "<br>Following successfully.<br>";
			} else {
			    echo "Error: " . $sql0 . "<br>" . $result0->error;
			}
		}
	} else {
			header("refresh:2;url=http://localhost/subscriptions2.php");
			echo "There is no subsaiddit based on your input.";
			exit(0);
	}
}
$mysqli->close();

?>