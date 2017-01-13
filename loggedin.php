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
?>
<!DOCTYPE html>
<html>
<head>
<style>

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-family: Arial, Helvetica, sans-serif;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: #45a049;
}

li.dropdown {
    display: inline-block;
}

li.logout{
  background-color: #4CAF50;
}

li.logout:hover {
    background-color: #45a049;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    font-family: Arial, Helvetica, sans-serif;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #cccccc}

.dropdown:hover .dropdown-content {
    display: block;
}

input[type=text] {
    width: 140px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 6px 6px;
    background-repeat: no-repeat;
    padding: 12px 30px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 80%;
}

</style>
</head>
<body>

<ul>
  <li class="dropdown">
    <a href="#" class="p">Populate</a>
    <div class="dropdown-content">
      <a href="http://localhost/addaccount2.php">Create an account</a>
      <a href="http://localhost/addPost2.php">Create a post</a>
      <a href="http://localhost/addCom2.php">Create a comment</a>
      <a href="http://localhost/likePost2.php">Like a post</a>
      <a href="http://localhost/isfriends2.php">Follow a user</a> 
      <a href="http://localhost/addSubsaiddit2.php">Create a subsaiddit</a>
      <a href="http://localhost/subscriptions2.php">Subscribe a subsaddit</a></li>
    </div>

  <li class="dropdown">
    <a href="#" class="l">Delete Post</a>
    <div class="dropdown-content">
      <a href="http://localhost/deletecontent.php">Delete Post</a></li>
    </div>

    <li style="float: right" class="logout"><a href="http://localhost/login.php">Log out</a></li>
    <li ><form name="form1" method ="post" action="searchresults.php">
  <input name="search" type="text" size="40" maxlength="50" placeholder="Search..."/>
  
</form>
</li>
  
</ul>

</form>

</body>
</html>

<br>


<?php
$username=$_SESSION['username'];
$_SESSION['username']=$username;
$password=$_SESSION['password'];

//Display the content of the subscription
$content = "SELECT posts.* FROM subscriptions, posts WHERE subscriptions.user = '$username' AND subscriptions.Subsaiddit = posts.Subsaiddit ORDER BY posts.upvotes DESC";

$result = $mysqli->query($content);
if ($result->num_rows > 0) {
     // output data of each row
    echo "<br>Dear ". $username. ", your subscriptions are: <br>";
    while($row = $result->fetch_assoc()) {
        $id_num = $row["postID"];
        echo "<br> Title: ". $row["title"];
       	echo "<br> Content: ". $row["content"];
        echo "<br> Up votes: ". $row["upvotes"];
        echo "<br> Down votes: ". $row["upvotes"];
        echo "<br> Publish Time: ". $row["publishTime"];
        echo "<br> Update Time: ". $row["updateTime"];
        echo "<br> Creator: ". $row["creator"]. "<br>";

        $getComID = "SELECT * FROM comments WHERE targetPost='$id_num'";
        $ComID = $mysqli->query($getComID);
        if($ComID->num_rows > 0){
          while($row2 = $ComID->fetch_assoc()){
            $id_com = $row2["commentID"];
            echo "     ". $row2["content"]. "<br>Publish Time: ". $row2["publishTime"]. "      Creator: ". $row2["creator"]. "<br>Upvotes: ". $row2["upvotes"]. "      Downvotes".$row2["downvotes"]."<br><br>";
            $getCom = "SELECT comments.content, comments.publishTime, comments.upvotes, comments.downvotes, comments.creator FROM comments WHERE targetComment = '$id_com'";
            $Comcom = $mysqli->query($getCom);
            if($Comcom->num_rows > 0){
              while($row3 = $Comcom->fetch_assoc()){
                echo "          ". $row3["content"]. "<br>     Publish Time: ". $row3["publishTime"]. "      Creator: ". $row3["creator"]. "<br>     Upvotes: ". $row3["upvotes"]. "      Downvotes".$row3["downvotes"]."<br><br>";
              }
            }
          }
        }
       echo  "<a href=\"http://localhost/loggedin.php\"><img src=\"http://localhost/thumbsup.png\"></a>";
      echo  "<a href=\"http://localhost/loggedin.php\"><img src=\"http://localhost/thumbsdown.png\"></a>"; 
      echo "<br><br>";
    }
} else {
    echo "<br>There is no subscriptions in your account.";
}

$mysqli->close();
?>