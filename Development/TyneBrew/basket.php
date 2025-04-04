<?php
session_start();

ini_set('display_errors', 1);

require_once 'DB.php';

// CSRF Token Generation and Validation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a CSRF token if one doesn't exist
}



// Handle deletion or quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    // Sanitize and validate inputs
    if(isset($_POST['update_quantity']) || isset($_POST['delete_item']))
    {
        $itemId = filter_var($_POST['item_id'], FILTER_VALIDATE_INT);
        if ($itemId === false) {
            die("Invalid item ID");
        }
    }

    if (isset($_POST['delete_item'])) {
        // Remove item from basket
        unset($_SESSION['basket'][$itemId]);
    } elseif (isset($_POST['update_quantity'])) {
        // Update quantity of item
        $newQuantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
        if ($newQuantity === false || $newQuantity <= 0) {
            unset($_SESSION['basket'][$itemId]); // Remove item if invalid quantity
        } else {
            $_SESSION['basket'][$itemId]['quantity'] = $newQuantity;
        }
    }

    if(isset($_POST['checkout']))
    {
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false)
        {
            $_SESSION['redirected'] = true;
            header('Location: loginn.php');
        }      
        else
        {
            header('Location: confirm_order.php');
        } 
    }
}

// Redirect to login page if the user is not logged in and trying to checkout
if (!isset($_SESSION['user_id']) && isset($_GET['action']) && $_GET['action'] == 'checkout') {
    header("Location: loginn.php?redirect=checkout.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tyne Brew Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: black; color: #fff;">
<div class="navbar">
    <div class="logo"> <img src="Images/mainlogo1.JPG"></div>
    <ul class="nav-list">
        <li><a href="index.php"><i class="fa fa-fw fa-home"></i>HOME</a></li>
        <li><a href="register.php"><i class="fa fa-sign-in"></i> REGISTER</a></li>
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

<br><br><br><br><br><br><br><br><br><br>
<h1 style="text-align: center; color: #ff9800;">Your Basket</h1>

<?php if (empty($_SESSION['basket'])): ?>
    <p style="text-align: center;">Your basket is empty!</p>
<?php else: ?>
    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; color: #fff;">
        <tr style="background-color: #444;">
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">Product</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">Price</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">Quantity</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">Total</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">Actions</th>
        </tr>
        <?php
        $totalPrice = 0;
        foreach ($_SESSION['basket'] as $itemId => $item):
            if ($item['quantity'] <= 0) {
                continue; // Skip items with quantity 0 or less
            }

            $itemTotal = $item['quantity'] * $item['price'];
            $totalPrice += $itemTotal;
        ?>
        <tr>
            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #444;"><?= htmlspecialchars($item['name']) ?></td>
            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">£<?= number_format($item['price'], 2) ?></td>
            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">
                <form method="POST" action="basket.php" style="display:inline;">
                    <input type="number" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" min="1" style="padding: 5px; width: 50px;">
                    <input type="hidden" name="item_id" value="<?= htmlspecialchars($itemId) ?>">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <button type="submit" name="update_quantity" style="padding: 5px 8px; background-color: #ff9800; color: white; border: none; font-size: 14px;">Update</button>
                </form>
            </td>
            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">£<?= number_format($itemTotal, 2) ?></td>
            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #444;">
                <form method="POST" action="basket.php" style="display:inline;">
                    <input type="hidden" name="item_id" value="<?= htmlspecialchars($itemId) ?>">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <button type="submit" name="delete_item" style="padding: 5px 8px; background-color: #f44336; color: white; border: none; font-size: 14px;">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<!-- Total Price just above the Proceed to Checkout button -->
<?php if (!empty($_SESSION['basket'])): ?>
    <div style="text-align: center; margin: 20px;">
        <p style="color: #fff; font-size: 18px; font-weight: bold;">Total: £<?= number_format($totalPrice, 2) ?></p>
    </div>
<?php endif; ?>

<div style="text-align: center; padding-top: 20px;">
    <?php if (empty($_SESSION['basket'])): ?>
        <!-- Disable the button if the basket is empty -->
        <button style="padding: 10px 20px; background-color: #ccc; color: white; border: none; cursor: not-allowed;" disabled>
            Proceed to Checkout
        </button>
    <?php else: ?>
        <!-- Proceed to Checkout button -->
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <input type="submit" value="Proceed To Checkout" name="checkout">
        </form>
    
        <!-- <a href="checkout.php" style="color: white; text-decoration: none;">
            <button style="padding: 10px 20px; background-color: #ff9800; color: white; border: none; cursor: pointer;">
                Proceed to Checkout
            </button>
        </a> -->
    <?php endif; ?>
</div>
<br><br>
    <div class="footer">&copy;<span id="year"> </span><span> Your Company Name. All rights reserved.</span></div>

</body>
</html>
