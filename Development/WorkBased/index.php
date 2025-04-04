
<?php

require "DB.php";
require "products.php";
session_start();
session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict' // or 'Lax'
]);

session_regenerate_id(true);
session_set_cookie_params([
    'secure' => true, // Ensure cookies are sent only over HTTPS
    'httponly' => true, // Prevent JavaScript access to the session cookie
]);

// Secure session management
session_regenerate_id(true); // Regenerate session ID to prevent session fixation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generates a CSRF token
}

$db = new DB();

$query = $db->connect()->prepare("SELECT * FROM tbl_products");
$query->execute();

$product = array();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $id = htmlspecialchars($row['id']);
    $name = htmlspecialchars($row['name']);
    $image = htmlspecialchars($row['image']);
    $product[] = new Product($id, $name, $image);
}

// Initialize the basket if it's not set
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

// Add item to the basket when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['products'])) {
    // Validate CSRF Token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token mismatch');
    }

    // Flag to check if any valid quantity is provided
    $itemSelected = false;

    // Iterate through the products array
    foreach ($_POST['products'] as $productData) {
        $product_id = filter_var($productData['id'], FILTER_SANITIZE_NUMBER_INT);
        $product_name = htmlspecialchars($productData['name']);
        $product_price = filter_var($productData['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $product_image = htmlspecialchars($productData['image']);
        $quantity = filter_var($productData['quantity'], FILTER_SANITIZE_NUMBER_INT);

        // If quantity is greater than 0, proceed with adding the item
        if ($quantity > 0) {
            $itemSelected = true;

            // Check if product already exists in the basket
            $found = false;
            foreach ($_SESSION['basket'] as &$item) {
                if ($item['id'] == $product_id) {
                    $item['quantity'] += $quantity; // Update quantity if the product is already in the basket
                    $found = true;
                    break;
                }
            }

            // If not found in the basket, add it
            if (!$found) {
                $_SESSION['basket'][] = array(
                    'id' => $product_id,
                    'name' => $product_name,
                    'price' => $product_price,
                    'image' => $product_image,
                    'quantity' => $quantity
                );
            }
        }
    }

    if (!$itemSelected) {
        echo "<script type='text/javascript'>
                alert('Please select an item first!');
                window.location = 'index.php'; // Redirect back to the product page
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Items added to your basket!');
                window.location = 'basket.php'; // Redirect to the basket page
              </script>";
    }
}

echo "Logged in: " . $_SESSION['loggedin'];
echo "User ID: " . $_SESSION['user_id'];

?>

<!DOCTYPE html>
<head>
    <title>Tyne Brew Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="navbar">
        <div class="logo"> <img src="img/logo.jpg">
        </div>
        <ul class="nav-list">
            <li><a href="index.php"><i class="fa fa-fw fa-home"></i>HOME</a></li>
            <li><a href="aboutus.php"><i class="fa fa-fw fa-home"></i>ABOUT US</a></li>
            <li><a href="loginn.php"><i class="fa fa-address-book"> </i> LOGIN</a></li>
            <li><a href="register.php"><i class="fa fa-sign-in"></i> REGISTER</a></li>
            <li><a href="admin.php"><i class="fa fa-sign-in"></i> ADMIN</a></li>
            <li><a href="basket.php"><img src="Images/basket.png" height="30px" width="30px"></a></li>
        </ul>
      
    </div>

    <div class="image-container">
        <img src="img/banner.JPG" alt="Coffee Image">
        <div class="image-title">
            <br>
            <h1>Cloe and Liam</h1>
            <br>
            
            <br>
            <br>
            <button class="button button1">
  <a href="loginn.php" style="color: white; text-decoration: none;">DONATE NOW</a>
</button>

        </div>
    </div>
    <br><br>
    <center>
        <h1 style="color:orange">ABOUT US</h1>
    </center><br><br>
    <div class="grid-container">

        <div class="main1">
            <img src="img/banner.JPG" alt="Coffee Image" height="auto" width="auto">
        </div>
        <div class="main2">
            <div class="aboutus">
                <br><br>
                <h1>How can you help</h1><br><br>
                <p>At Tyne Brew Coffee, we’re passionate about delivering the perfect cup of coffee, carefully
                    crafted
                    with the finest beans. As a local business, we’ve built a loyal community of coffee lovers who
                    enjoy
                    our wide variety of hot beverages and snacks. <br><br>Now, we’re excited to expand our reach by
                    launching an
                    eCommerce platform to offer our signature coffee blends to coffee enthusiasts everywhere. With a
                    focus on quality and sustainability, our online store will allow customers to experience the
                    rich
                    flavors of Tyne Brew Coffee from the comfort of their own homes. Join us in the journey of
                    savoring
                    coffee like never before!</p>
                <br>
                <br>

            </div>

        </div>
    </div>

    <br>

    <h1>
        <center>SPECIAL OFFER!</center> <center>    EVERYTHING FOR £19.99</center>
    </h1>
    <form action="index.php" method="POST">
        <div class="product-item-container">
            <?php foreach ($product as $p): ?>
                <div class="product-item">
                    <p><?= htmlspecialchars($p->name()) ?></p>
                    <img src="<?= htmlspecialchars($p->image()) ?>" alt="Product Image" class="product-image" />
                    <p class="product-price">Price: £19.99</p>

                    <div class="quantity-container">
                        <button type="button" class="quantity-btn" onclick="changeQuantity(<?= $p->id() ?>, 1)">+</button>
                        <input type="number" name="products[<?= $p->id() ?>][quantity]" id="quantity-<?= $p->id() ?>"
                            value="0" min="0" required>
                        <button type="button" class="quantity-btn" onclick="changeQuantity(<?= $p->id() ?>, -1)">-</button>
                    </div>

                    <!-- Add hidden inputs to send product details on form submit -->
                    <input type="hidden" name="products[<?= $p->id() ?>][id]" value="<?= $p->id() ?>">
                    <input type="hidden" name="products[<?= $p->id() ?>][name]" value="<?= $p->name() ?>">
                    <input type="hidden" name="products[<?= $p->id() ?>][price]" value="19.99">
                    <input type="hidden" name="products[<?= $p->id() ?>][image]" value="<?= $p->image() ?>">

                    <!-- "More Info" button that does not submit the form -->
                    <a href="information.php?id=<?= $p->id() ?>"><button type="button" class="btn more-info-btn">More
                            Info</button></a>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> <!-- CSRF Token -->
        <center>
            <button type="submit" class="btn add-to-cart-btn" style="width: 50%;">Add to Cart</button>
        </center>
    </form>
    <br><br><br>
    
<h1>
    <center>Customer Reviews</center>
</h1>
<div class="review-container" style="display: flex; justify-content: center; gap: 20px; margin: 20px auto; max-width: 1700px;">
    <!-- Review Box 1 -->
    <div class="review-box" style="flex: 1; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 10px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h3 style="color: #333;">John Doe</h3>
        <p style="font-style: italic; margin-bottom: 10px;">"Absolutely love the coffee! It's smooth, rich, and always fresh. Highly recommend Tyne Brew Coffee! Tyne Brew Coffee has truly exceeded expectations with its smooth, rich, and flavorful blends. Customers rave about the caramel blend, perfect for morning routines, and the bold intensity of the dark roast that energizes the start of their day. The eco-friendly packaging and dedication to sustainability have also earned praise from environmentally conscious coffee lovers"</p>
        <div style="color: #ffc107; font-size: 18px;">
            ★ ★ ★ ★ ★ <span style="color: #333;">(4.9)</span>
        </div>
    </div>

    <!-- Review Box 2 -->
    <div class="review-box" style="flex: 1; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 10px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h3 style="color: #333;">Jane Smith</h3>
        <p style="font-style: italic; margin-bottom: 10px;">"The best coffee I've ever tasted! The online ordering process was simple, and the delivery was fast. Whether it’s the creamy latte blend or the incredible variety of flavors, there's something for every coffee enthusiast. Many appreciate the fast delivery and the simple online ordering process, making it easy to enjoy premium coffee from the comfort of home. "</p>
        <div style="color: #ffc107; font-size: 18px;">
            ★ ★ ★ ★ ★ <span style="color: #333;">(4.8)</span>
        </div>
    </div>

    <!-- Review Box 3 -->
    <div class="review-box" style="flex: 1; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 20px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h3 style="color: #333;">Sam Wilson</h3>
        <p style="font-style: italic; margin-bottom: 10px;">"Tyne Brew Coffee is now my go-to for premium coffee. Love the flavors and their dedication to sustainability. Tyne Brew Coffee isn’t just a brand; it’s a community of coffee lovers who value quality and perfection in every cup"</p>
        <div style="color: #ffc107; font-size: 18px;">
            ★ ★ ★ ★ ☆ <span style="color: #333;">(4.7)</span>
        </div>
    </div>
</div>
<form action="search_results.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search Items " required>
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
<br><br>
    <div class="footer">&copy;<span id="year"> </span><span> Your Company Name. All rights reserved.</span></div>
    <script>
        function changeQuantity(productId, increment) {
            const quantityInput = document.getElementById(`quantity-${productId}`);
            let currentQuantity = parseInt(quantityInput.value);

            // Update the quantity based on the increment value
            currentQuantity += increment;
            if (currentQuantity < 1) currentQuantity = 1; // Ensure quantity is at least 1
            quantityInput.value = currentQuantity;
        }
    </script>
</body>

</html>
