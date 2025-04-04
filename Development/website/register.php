<?php

ini_set("display_errors", 1);
require "DB.php";
require "products.php";

$db = new DB;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tyne Brew Coffee</title>
</head>


<body>
    <form method="post">
        <input type="email" placeholder="Email.." name="email">
        <input type="text" placeholder="Username.."name="username">
        <input type="password" placeholder="Password.."name="password">
        <input type="password" placeholder="Confirm Password.."name="confpass">
        <input type="submit" value='Press heree'name="register">
    </form>

    <?php
    if(isset($_POST['register'])){
        //set post variables
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confpass = $_POST['confpass'];

        if(empty($email) || empty($username) || empty($password) || empty($confpass)){
            }

        if($password != $confpass){
            echo'Your password do not matach!';
            die();

        }
        
        if(strlen($email) < 5 || strlen($email) > 50){
            echo ' Your email does not meet the length requirements!';
            die();

        }

        if(strlen($username) < 3 || strlen($username) > 12){

            echo ' Your username does not meet the length requirements!';
            die();

        }

        if(strlen($password) < 3 || strlen($password) > 100){

            echo ' Your password does not meet the length requirements!';
            die();

        }


        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo 'Invalid Email';
            die();
        }

        if(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){

            echo'Invalid username!';
            die();
        }

        $conn = $db->connect();
        if(!$conn){echo 'Database failed to connect!';}
        $emailQuery = $conn->prepare("SELECT * FROM Users WHERE email = :email OR username = :username");
        $emailQuery->bindParam(':email', $email, PDO::PARAM_STR);
        $emailQuery->bindParam(':username', $username, PDO::PARAM_STR);
        $emailQuery->execute();

        if($emailQuery->rowCount() > 0){
            echo 'Email or username is already in use'; 
            die();
        }
        else{
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
            $uuid = generateUUID();
            $insertQuery = $conn->prepare("INSERT INTO Users (email, username, password, UUID) Values (:email, :username, :password, :uuid)");
            $insertQuery->bindParam(":email", $email, PDO::PARAM_STR);
            $insertQuery->bindParam(":username", $username, PDO::PARAM_STR);
            $insertQuery->bindParam(":password", $encryptedPassword, PDO::PARAM_STR);
            $insertQuery->bindParam(":uuid", $uuid, PDO::PARAM_STR);


            $insertQuery->execute();

            if($insertQuery){


                echo 'Account created';
            }

        }
    }

        function generateUUID(){
            return time() . bin2hex(random_bytes(8));
        }

    ?> 






</body>
</html>
