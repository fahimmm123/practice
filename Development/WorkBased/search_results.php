<?php
session_start();

ini_set("display_errors", 1);


require "DB.php";
require "products.php";

session_start();
session_regenerate_id(true);  // Regenerate session ID to prevent session fixation

// Generate CSRF token if it doesn't exist
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$db = new DB();

// Sanitize search term
$searchTerm = isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : '';

// Prepare SQL query to search products by name
$query = $db->connect()->prepare("SELECT * FROM tbl_products WHERE name LIKE :searchTerm");
$query->execute(['searchTerm' => "%$searchTerm%"]);

$product = array();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $name = $row['name'];
    $image = $row['image'];
    $product[] = new Product($id, $name, $image);
}

// Initialize the basket if it's not set
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

// Add item to the basket when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    // Verify CSRF token
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token mismatch');
    }

    $product_id = (int) $_POST['product_id'];  // Ensure it's an integer
    $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
    $product_price = (float) $_POST['product_price'];  // Ensure it's a float
    $product_image = htmlspecialchars($_POST['product_image'], ENT_QUOTES, 'UTF-8');
    $quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0
        ? (int) $_POST['quantity']
        : 1;

    // Add or update the item in the basket
    $found = false;
    foreach ($_SESSION['basket'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['basket'][] = array(
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => $quantity
        );
    }

    echo "<script type='text/javascript'>
            alert('Item added to your basket!');
            window.location = 'search_results.php?search=$searchTerm'; 
          </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tyne Brew Coffee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="logo"><img src="Images/mainlogo1.JPG"></div>
        <ul class="nav-list">
            <li><a href="index.php">HOME</a></li>
            <li><a href="aboutus.php"><i class="fa fa-fw fa-home"></i>ABOUT US</a></li>
            <li><a href="loginn.php">LOGIN</a></li>
            <li><a href="register.php">REGISTER</a></li>
            <li><a href="create.php">ADMIN</a></li>
            <li><a href="basket.php"><img src="Images/basket.png" height="30px" width="30px"></a></li>
        </ul>
    </div>

    <br><br><br><br><br><br><br><br><br><br><h1>Search Results for: "<?= htmlspecialchars($searchTerm) ?>"</h1>
    
    <?php if (empty($product)): ?>
        <p>No products found for your search.</p>
    <?php else: ?>
        <div class="product-item-container">
            <?php foreach ($product as $p): ?>
                <div class="product-item">
                    <p><?= htmlspecialchars($p->name()) ?></p>
                    <img src="<?= htmlspecialchars($p->image()) ?>" alt="Product Image" />
                    <p class="product-price">Price: £19.99</p>

                    <form action="search_results.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $p->id() ?>">
                        <input type="hidden" name="product_name" value="<?= $p->name() ?>">
                        <input type="hidden" name="product_price" value="19.99">
                        <input type="hidden" name="product_image" value="<?= $p->image() ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="quantity-container">
                            <input type="number" name="quantity" value="1" min="1" required>
                        </div>

                        <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
