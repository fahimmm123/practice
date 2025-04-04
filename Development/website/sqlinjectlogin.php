<?php  

   ini_set('display_errors', 1);


   require'DB.php';

   $db = new DB;

   session_start();
   
if(isset($_POST['submit']))
{
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        

        $query= $db->connect()->prepare("SELECT username FROM 214_users Where username = ? AND password= ?");
        //$query->bindParam(':username', $username, PDO::PARAM_STR);
        //query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute(array($username, $password));

        if ($query->rowCount() > 0)
        {

            $_SESSION['username'] = $username;
            header('Location: sqlInjecrSuccess.php');

        }
        else
        {
            echo "Incorrect credentials.";
        }

    }

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>
    <h1>Login Test Secured o</h1>

    <form method="post">
        <label for = "username"> Username</label><br>
        <input type ="text" placeholder=" Please enter you username" name="username" id="username">
        <br>
        <label for="password"> Password:</label><br>
        <input type="text" placeholder = "Please enter your pasword" name="password" id="password">
        <br><br>
        <input type="submit" name="submit" value="login">






    </form>
</body>
</html>