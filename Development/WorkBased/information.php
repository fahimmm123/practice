<?php
require "DB.php"; // Ensure DB connection is established
require "products.php"; // If needed for handling product-related logic
session_start();

ini_set("display_errors", "1");

if (isset($_GET["id"])) {

    $id = $_GET['id'];
    $db = new DB;
    
    // Prepare and execute the query safely
    $query = $db->connect()->prepare("SELECT * FROM tbl_products WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    // Fetch the product details from the database
    $product = null;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $product = [
            'id' => $row['id'],
            'name' => $row['name'],
            'image' => $row['image'],
            'Description' => $row['Description'], // Pull the description
        ];
    }

    // Handle case where no product is found
    if (!$product) {
        echo "Product not found!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tyne Brew Coffee</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Permanent+Marker&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div class="navbar">
        <div class="logo"> <img src="Images/mainlogo1.JPG">
        </div>
        <ul class="nav-list">
            <li><a href="index.php"><i class="fa fa-fw fa-home"></i>HOME</a></li>
            <li><a href="aboutus.php"><i class="fa fa-fw fa-home"></i>ABOUT US</a></li>
            <li><a href="loginn.php"><i class="fa fa-address-book"> </i> LOGIN</a></li>
            <li><a href="register.php"><i class="fa fa-sign-in"></i> REGISTER</a></li>
            <li><a href="admin.php"><i class="fa fa-sign-in"></i> ADMIN</a></li>
            <li><a href="basket.php"><img src="Images/basket.png" height="30px" width="30px"></a></li>
        </ul>
        <form action="search_results.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search Items " required>
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
    </div>
<br><br><br><br><br><br>
    <div class="product-container1" style="text-align: center; padding: 20px;">
    <br><h1 class="product-name" style="font-size: 2em; color: orange;"><?= htmlspecialchars($product['name']) ?></h1>
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width: 80%; height: auto; margin-top: 20px;" />
        <p class="product-description" style="color: black; font-size: 1.1em; margin-top: 20px; text-align: justify; line-height: 1.6;"><?= nl2br(htmlspecialchars($product['Description'])) ?></p>
        <div>
            <button class="back-btn" style="background-color:rgb(225, 199, 27); color: white; padding: 12px 24px; border: none; cursor: pointer; border-radius: 5px; margin-top: 20px; font-size: 1em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <a href="index.php" style="color: white; text-decoration: none;">Back to Products</a>
            </button>
        </div>
    </div>
    <br><br>
    <div class="footer">&copy;<span id="year"> </span><span> Your Company Name. All rights reserved.</span></div>

</body>

</html>
