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
$posts=$_POST["post"];
//echo "hahahah";
if(empty($_POST["post"])) {
	header("refresh:2;url=http://localhost/likePost2.php");
	echo "Please fill the blank.";
	exit(0);
} else {
	$post = "SELECT posts.postID FROM posts WHERE posts.title = '$posts'";
    $exist = $mysqli->query($post);
    //echo "hahahah";
    if ($exist->num_rows > 0) {
        $row = $exist->fetch_assoc();
        $temp = $row["postID"];
        $checking = "SELECT favourites.post FROM favourites WHERE favourites.post = '$temp'";
        $check = $mysqli->query($checking);
        if($check->num_rows > 0) {
        	header("refresh:2;url=http://localhost/likePost2.php");
        	echo "The post already exists in your favourite list. Please add another post.";
        } else {
	    	$sql = "INSERT INTO favourites (user, post) VALUES ('$username', $temp)";
			$result = $mysqli->query($sql);
			if($result === TRUE) {
				header("refresh:2;url=http://localhost/loggedin.php");
			 	echo "<br>Post liked successfully.<br>";
			} else {
			    echo "Error: " . $sql0 . "<br>" . $result0->error;
			}
        }
	} else {
		header("refresh:2;url=http://localhost/likePost2.php");
		echo "There is no post based on your input.";
		exit(0);
	}
}
$mysqli->close();

?>