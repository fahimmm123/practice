<?php
   session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Login successful</title>
</head>
<body>
    <h1>Welcome <?= $_SESSION['username']?>!</h1>
    <b>Welcome</b>
    <em>Welcome</em>

</body>
</html>