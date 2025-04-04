<?php

require "DB.php";
require "products.php";


ini_set("display_errors", "1");

if (isset($_GET["id"])) {

    $id = $_GET['id'];
    $db = new DB;
    $query = $db->connect()->prepare("SELECT * FROM tbl_products WHERE id = '$id'");
    $query->execute();


    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $name = $row['name'];
        $image = $row['image'];
        $product = new $Product($id, $name, $image);
    }
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
</head>



<body>
    <h1> <?= $product->name() ?></h1>
    <img src="<?= $product->image() ?>" width= "200px", height= "200px" />
    <p>Product Name: <?= $product->name() ?></p>









</body>



</html>