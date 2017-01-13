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
//$creator=$_POST["creator"];
$creator = $_SESSION["username"];

if(empty($title)||empty($content)||empty($creator)){
 	echo "please fill the blank.";
 	header("refresh:2;url=http://localhost/addCom2.php");
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
if($find->num_rows == 1){
	$row = $find->fetch_assoc();
	$ID = $row["postID"];
	$addaCom="INSERT INTO comments(content, targetPost,creator) VALUES ('$content','$ID','$creator')";
	$add=$conn->query($addaCom);
	if($add === TRUE){
		echo "Comment adds successfully.<br>";
		echo "Back to front-page in 2 seconds.<br>";
		header("refresh:3;url='http://localhost/loggedin.php'");
		exit(0);
	}else{
		header("refresh:2;url=http://localhost/addCom2.php");
		echo "Comments added failed. Please try again.";
	}
}else{
	echo "No post found with title $title. <br><br>";
	header("refresh:2;url=http://localhost/addCom2.php");
	exit(0);
}

?>

</body>
</html>