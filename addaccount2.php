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

input[type=password], select{
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


</style>
<body>

<p></p>

<div>

  <form action="addaccount1.php" method = "post">
    <p>Sign Up</p>
    
    <label for="fname">Username</label>
    <input type="text" name="username">

    <label for="lname">Password</label>
    <input type="password" name="password">
  
    <input type="submit" value="Submit">
    <input type="button" value="HomePage" name="homepage" onclick="location='http://localhost/loggedin.php'">
  </form>
</div>

</body>
</html>