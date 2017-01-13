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

<p>Search Result</p>

<?php 

DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'aza');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_DATABASE', 'PROJECT');

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
 die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$title = $_POST['search'];

if(!isset($title)){
	header("Location:index.php");
}

$search_sql = "SELECT * FROM posts WHERE title LIKE '%".$title."%' OR content LIKE '%".$title."%'";
$search_query = $conn->query($search_sql);
if ($search_query->num_rows > 0) {
	while($row = $search_query->fetch_assoc()) {
		$id_num = $row["postID"];
    	echo "Title: " . $row["title"]. "<br>URL: " . $row["URL"]. "<br>Creator: " . $row["creator"]. "<br>Publish Time: " . $row["publishTime"]. "&nbsp Update Time: " . $row["updateTime"]. "<br><br>" . $row["content"]. "<br><br>UpVotes: ". $row["upvotes"]. "&nbsp DownVotes: " . $row["downvotes"]. "<br>";
    	$getComID = "SELECT * FROM comments WHERE targetPost='$id_num'";
		$ComID = $conn->query($getComID);
		if($ComID->num_rows > 0){
			while($row2 = $ComID->fetch_assoc()){
				$id_com = $row2["commentID"];
				echo "     ". $row2["content"]. "<br>Publish Time: ". $row2["publishTime"]. "      Creator: ". $row2["creator"]. "<br>Upvotes: ". $row2["upvotes"]. "      Downvotes".$row2["downvotes"]."<br>";
				$getCom = "SELECT comments.content, comments.publishTime, comments.upvotes, comments.downvotes, comments.creator FROM comments WHERE targetComment = '$id_com'";
				$Comcom = $conn->query($getCom);
				if($Comcom->num_rows > 0){
					while($row3 = $Comcom->fetch_assoc()){
						echo "          ". $row3["content"]. "<br>     Publish Time: ". $row3["publishTime"]. "      Creator: ". $row3["creator"]. "<br>     Upvotes: ". $row3["upvotes"]. "      Downvotes".$row3["downvotes"]."<br>";
					}
				}
			}
		}
		echo  "<a href=\"http://localhost/loggedin.php\"><img src=\"http://localhost/thumbsup.png\"></a>";
      echo  "<a href=\"http://localhost/loggedin.php\"><img src=\"http://localhost/thumbsdown.png\"></a>"; 
		echo "<br><br>";

    }
}else{
    echo "No post with \"".$title."\" found.<br>";
    echo "Please try other key word.";
    header("refresh:3;url='http://localhost/loggedin.php'");
}

$conn->close();
?>

</body>
</html>