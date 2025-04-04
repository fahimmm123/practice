<?php
session_start();

require_once 'DB.php';

ini_set('display_errors', 1);

if (empty($_SESSION['loggedin'])) {
    $_SESSION['redirected'] = true;
    header('Location: loginn.php');
}

if (empty($_SESSION['basket'])) {
    header('Location: index.php');
}

$orderPlaced = false;  // Flag to check if the order has been successfully placed

if (isset($_POST['process'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    $totalPrice = 0;
    $userId = $_SESSION['user_id'];

    $db = new DB;
    $conn = $db->connect();

    foreach ($_SESSION['basket'] as $item) {
        if (isset($item['price'], $item['quantity']) && is_numeric($item['price']) && is_numeric($item['quantity'])) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
    }

    try {
        // Insert the order into the orders table
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
        $stmt->execute([$userId, $totalPrice]);

        if ($stmt->rowCount() === 0) {
            throw new Exception("Failed to insert the order.");
        }

        $orderId = $conn->lastInsertId();  // Get the last inserted order ID.

        // Insert the order items into the order_items table
        foreach ($_SESSION['basket'] as $itemId => $item) {
            if (isset($item['price'], $item['quantity']) && is_numeric($item['price']) && is_numeric($item['quantity'])) {
                $stmt = $db->connect()->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_per_item, total_price) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$orderId, $itemId, $item['quantity'], $item['price'], $item['quantity'] * $item['price']]);
            }
        }

        // Clear the basket session after successful checkout
        unset($_SESSION['basket']);
        $orderPlaced = true; // Set the flag to true when order is successfully placed

    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        echo $e->getMessage() . ": There was an error processing your order. Please try again later.";
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        echo $e->getMessage() . "There was an error processing your order. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<head>
    <title>Tyne Brew Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
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
        
    </div>
    <br><br><br><br><br><br>

<div class="container" style="max-width: 1200px; margin: 50px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);">
    <h1 style="text-align: center; font-family: 'Encode Sans Semi Expanded', sans-serif; color: #e67e22;">Order Confirmation</h1>

    <?php if ($orderPlaced): ?>
        <div class="confirmation-message" style="background-color: #e67e22; color: white; padding: 15px; text-align: center; margin-bottom: 20px; border-radius: 5px;">
            Your order has been successfully placed. Thank you!
        </div>
    <?php endif; ?>

    <p style="text-align: center;">Please click below to process your order.</p>

    <form class="process-form" method="POST" style="text-align: center;">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <input type="submit" value="Process Order" name="process" style="padding: 10px 20px; background-color: #e67e22; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
    </form>
</div>

<div class="footer" style="background-color: #e67e22; color: white; padding: 15px 0; text-align: center; position: fixed; bottom: 0; width: 100%; font-weight: 500;">
    <p>&copy; <span id="year"><?php echo date('Y'); ?></span> Tyne Brew Coffee. All rights reserved.</p>
    <p>Visit our <a href="aboutus.php" style="color: #e67e22; text-decoration: none;">About Us</a> page for more information.</p>
</div>

</body>
</html>