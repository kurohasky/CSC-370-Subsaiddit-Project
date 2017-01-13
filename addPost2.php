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
	font-family: Arial, Helvetica, sans-serif;
	font-size: 1.2em;
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
    font-family: Arial, Helvetica, sans-serif;
}

input[type=submit]:hover {
    background-color: #45a049;
}

input[type=button] {
    width: 100%;
    background-color: #4d79ff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    font-size: 1.2em;
    cursor: pointer;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 1.3em;
}
</style>
<body>

<p></p>


<div>
  <form action="addPost1.php" method="post">
    <p>Enter the post information:<br><br></p>
    <label for="fname">Post Title</label>
    <input type="text" id="fname" name="title">

    <label for="lname">Content</label>
    <input type="text" id="lname" name="content">
  
  	<label for="lname">URL (Enter if it is a link post)</label>
    <input type="text" id="lname" name="url">

    <label for="lname">Subsaiddit</label>
    <input type="text" id="lname" name="subsaiddit">
    
    <input type="submit" value="Submit">
    <input type="button" value="HomePage" name="homepage" onclick="location='http://localhost/loggedin.php'">
  </form>
</div>

</body>
</html>