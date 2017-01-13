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


input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

label{
    font-size: 1.2em;
    font-family: Arial, Helvetica, sans-serif;
}

input[type=password], select{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

p {
    position: relative;
    text-align: center;
    font-size: 1.6em;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    font-size: 1.2em;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>


<body>
<div>

  <form action="checkEmpty.php" method = "post">
    <p>Subsaddit Login</p>
    
    <label>Username</label>
    <input type="text" name="username">

    <label>Password</label>
    <input type="password" name="password">
  
    <input type="submit" value="Submit">
  </form>
</div>


<?php
 DEFINE('DB_USERNAME', 'root');
 DEFINE('DB_PASSWORD', 'aza');
 DEFINE('DB_HOST', 'localhost');
 DEFINE('DB_DATABASE', 'PROJECT');

 $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

 if (mysqli_connect_error()) {
 	die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
 }

// Display the top voted posts from the default subsaiddits with descending sequence.
 $content = "SELECT posts.* FROM posts, subsaiddit WHERE subsaiddit.isDefault = 1 AND subsaiddit.title = posts.subsaiddit ORDER BY posts.upvotes DESC";

$result = $mysqli->query($content);
if ($result->num_rows > 0) {
     // output data of each row
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
    echo "There is no subsaiddits.";
}
?>
</form>

</body>
</html>