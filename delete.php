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
$title=$_POST["title"];
if(empty($_POST["title"])) {
    header("refresh:2;url=http://localhost/deletecontent.php");
    echo "Please fill the blank.";
    exit(0);
} else {
    //DELETE POST IN THE DATABASE
    $PID = "SELECT posts.postID FROM posts WHERE posts.title = '$title'";
    $result1 = $mysqli->query($PID);
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
           $temp = $row["postID"];
        }
        $CID = "SELECT comments.commentID FROM comments WHERE comments.targetPost = '$temp'";
        $result = $mysqli->query($CID);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $temp1 = $row["commentID"];
            }
            $result2 = "DELETE FROM posts WHERE posts.postID = '$temp'";
            $result3 = "DELETE FROM comments WHERE comments.targetPost = '$temp'";
            $result4 = "DELETE FROM comments WHERE comments.targetComment = '$temp1'";
            $Pdelete = $mysqli->query($result2);
            if($Pdelete === TRUE) {
                $Cdelete = $mysqli->query($result3);
                if($Cdelete === TRUE) {
                    $CCdelete = $mysqli->query($result4);
                    if($CCdelete === TRUE) {
                        header("refresh:2;url=http://localhost/loggedin.php");
                        echo "<br>Post and relevant comments deleted successfully.<br>";
                    } else {
                        header("refresh:2;url=http://localhost/deletecontent.php");
                        echo "Error deleting record";
                    }
                }
            } else {
                header("refresh:2;url=http://localhost/deletecontent.php");
                echo "There is no post.";
            }
        } else {
            $result2 = "DELETE FROM posts WHERE posts.postID = '$temp'";
            $Pdelete = $mysqli->query($result2);
            if($Pdelete === TRUE) {
                echo "<br>Post deleted successfully.<br>";
                header("refresh:2;url=http://localhost/loggedin.php");
            }
        }
    } else {
        header("refresh:2;url=http://localhost/deletecontent.php");
        echo "Post can not be found.";
    }
}



?>