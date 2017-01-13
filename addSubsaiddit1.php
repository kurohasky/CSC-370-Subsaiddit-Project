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
$description=$_POST["description"];
//$creator=$_POST["creator"];
$creator = $_SESSION["username"];
$isDefault = $_POST["isDefault"];
//echo "$title<br>";
//echo "$description<br>";
//echo  "$creator<br>";
//echo "$isDefault<br><br>";

if(empty($title)||empty($description)||empty($isDefault)){
 	echo "please fill the blank.";
 	header("refresh:2;url=http://localhost/addSubsaiddit2.php");
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
//echo "222";
$findPost="SELECT * FROM subsaiddit WHERE title='$title'";
$find=$conn->query($findPost);
if($find->num_rows > 0){
	echo "This Subsaiddit exists.<br>Please try another one.";
	header("refresh:3;url='http://localhost/addSubsaiddit2.php'");
}else{
	$Sub = "INSERT INTO subsaiddit(isDefault, title, founder, description) VALUES ($isDefault, '$title', '$creator', '$description')";
	//echo "3333";
	$add=$conn->query($Sub);
	//echo "333";
	if($add === TRUE){
		echo "Subsaiddit adds successfully.<br>";
		echo "Back to front-page in 2 seconds.<br>";
		header("refresh:3;url='http://localhost/loggedin.php'");
		exit(0);
	}
}

?>

</body>
</html>