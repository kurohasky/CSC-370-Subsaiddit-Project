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
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$iterations = 1000;

$salt = "~!@#$%^&*()_+";
//$password="asdfghfdkjsdgu";
$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 64);
//echo $iterations;
//echo $salt;

//echo $username;
//"<br>"
//echo $password;
//echo $hash;

?>

<?php
 DEFINE('DB_USERNAME', 'root');
 DEFINE('DB_PASSWORD', 'aza');
 DEFINE('DB_HOST', 'localhost');
 DEFINE('DB_DATABASE', 'PROJECT');

 $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

 if (mysqli_connect_error()) {
 	die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
 }
 
 //echo "<br><br>Connected successfully.<br>";


// Check whether the inputed username and passord exist in database.
 $match = "SELECT * FROM accounts WHERE username = '$username' AND password = '$hash'";

 $result = $mysqli->query($match);

if($result->num_rows == 1) {
	echo "Congratulations! Login successfully.";
	header("refresh:2;url=http://localhost/loggedin.php");
} else {
	echo "Username or Password is not correct. Please try again.";
	//echo "1<br>";
	//echo "2<br>";

	header("refresh:2;url=http://localhost/login.php");
	//echo $hash;
}

// // INSERT CONTENT INTO DATABASE
//  $sql0 = "INSERT INTO PEOPLE (NAME, PASSWORD) VALUES ('$username', '$hash')";
//  $result0 = $mysqli->query($sql0);
//  if($result0 === TRUE) {
//  	echo "<br>New record created successfully.<br>";
// } else {
//     echo "Error: " . $sql0 . "<br>" . $result0->error;
// }

// // SHOW CONTENT IN THE DATABASE
// $sql1 = "SELECT username, password FROM accounts";
// $result1 = $mysqli->query($sql1);
// if ($result1->num_rows > 0) {
//      // output data of each row
//      while($row = $result1->fetch_assoc()) {
//         echo "<br> Name: ". $row["username"]. " - Password: ". $row["password"]. " <br>";
//      }
// } else {
//     echo "0 results";
// }

// //DELETE CONTENT IN THE DATABASE
// $sql2 = "DELETE FROM PEOPLE WHERE NAME=''";
// $result2 = $mysqli->query($sql2);
// if ($result2 === TRUE) {
//      echo "<br>New record deleted successfully.<br>";
// } else {
//     echo "Error deleting record: " . $result2->error;
// }


$mysqli->close();
?>
</body>
</html>