<?php

ini_set("display_errors", 1);
require "DB.php";
require "products.php";

$db = new DB();

$query = $db->connect()->prepare("SELECT * FROM tbl_products");
$query->execute();

$product = array();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $name = $row['name'];
    $image = $row['image'];
    $product[] = new Product($id, $name, $image);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tyne Brew Coffee</title>
</head>
<body>

    <div class="topnav">
        <a href="indexx.php"><i class="fa fa-fw fa-home"></i>Home</a>
        <a href="login.php"><i class="fa fa-address-book" aria-hidden="true"></i>Posts</a>
        <a href="signin.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Log in</a>
        <a href="register.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Register</a>
        <div class="login">
            <button type="button" class="button" onclick="window.location.href='login.php';">Add to Cart</button>
        </div>
    </div>

    <h1>Tyne Brew Coffee</h1>

    <?php foreach($product as $p): ?>
        <img src="<?= $p->image() ?>" style="width:200px; height:200px;"/>
        <p>Product Name: <?= $p->name(); ?></p>
        <a href="information.php?id=<?= $p->id() ?>"><button class="btn">More Info</button></a>
        <br>
    <?php endforeach; ?>

</body>
</html>
