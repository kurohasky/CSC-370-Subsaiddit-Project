<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>

<style>
html{
    background-color: #f2f2f2;
}
</style>

<body>

<?php
$title=$_POST["title"];
$content=$_POST["content"];
$subsaiddit=$_POST["subsaiddit"];
//$creator=$_POST["creator"];
$creator = $_SESSION["username"];

if(empty($title)||empty($content)||empty($subsaiddit)){
 	echo "please fill the blank.";
 	header("refresh:2;url=http://localhost/addPost2.php");
 	exit(0);
 }

DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'aza');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_DATABASE', 'PROJECT');

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
	die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
 }

$findPost="SELECT * FROM posts WHERE title='$title'";
$find=$conn->query($findPost);
if($find->num_rows > 0){
	echo "Post already exists.<br>Please use another title.";
	header("refresh:3;url='http://localhost/addPost2.php'");
	exit(0);
}
if(empty($_POST["url"])){
	$addapost="INSERT INTO posts(title, content, creator, Subsaiddit) VALUES ('$title','$content','$creator','$subsaiddit')";
	$add=$conn->query($addapost);
	if($add === TRUE){
		echo "Post adds successfully.<br>";
		echo "Back to front-page in 2 seconds.<br>";
		header("refresh:3;url='http://localhost/loggedin.php'");
		exit(0);
	}
}else{
	$url=$_POST["url"];
	$addapost2="INSERT INTO posts(title, content, url, creator, Subsaiddit) VALUES ('$title','$content','$url','$creator','$subsaiddit')";
	$add2=$conn->query($addapost2);
	if($add2 === TRUE){
		echo "Post adds successfully.<br>";
		echo "Back to front-page in 2 seconds.<br>";
		header("refresh:3;url='http://localhost/loggedin.php'");
		exit(0);
	}	
}

?>

</body>
</html>