<?php
 require_once 'sessionManager.php'
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XXS Reflected</title>
</head>
<body>
   <h2>XSS Reflected Attack Example</h2>

   <form method="GET">
    <input type="text" placeholder="Enter a search term" name="search"><br>
    <input type="submit" name="submit" valuw="search">
    
   </form>
   <p>
    <?php if(isset($_GET['submit'])){
        echo " You have searched for ". htmlspecialchars($_GET['search']);
    }
    ?>
   </p>


</body>
</html>