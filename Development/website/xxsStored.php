<?php

ob_start();
require_once 'csp.php';
ini_set("display_errors", 1);
require 'DB.php';
$db = new DB;


if(isset($_POST['submit'])){
    $query = $db->connect()->prepare("INSERT INTO xxsComments (comment) VALUES (:comment)");
    $query -> bindParam(":comment", $_POST['comment'], PDO::PARAM_STR);
    $query-> execute();
}
$comments= array();
$query = $db->connect()->query("SELECT * FROM xxsComments");

while ($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $comments[] = $row['comment'];
}
ob_end_flush();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xxs stored demo</title>
</head>
<body>
    <h2>XXS stored demo</h2>
    <form method="POST">
        <input type="text" placeholder="Enter a comment.." name="comment">
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php foreach($comments as $comment): ?>
        <?= htmlspecialchars($comment ) ?>
        <br>
    <? endforeach ?>
</body>
</html>