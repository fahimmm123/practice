<?php
session_start();
ini_set("display_errors", "1");

require 'DB.php';

function validate_and_sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

if (isset($_POST['upload'])) {
    // Sanitize product name
    $name = validate_and_sanitize($_POST['name']);

    // Handle file upload with proper security measures
    $targetDir = "img/";
    $fileName = basename($_FILES['image']['name']);
    $targetFile = $targetDir . uniqid() . '-' . $fileName; // Ensure unique file name
    $type = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $supported = ['jpg', 'jpeg', 'png'];

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "File already exists";
        exit();
    }

    // Check file size (max 3MB)
    if ($_FILES['image']['size'] > 3000000 || $_FILES['image']['size'] === 0) {
        echo "File size error";
        exit();
    }

    // Validate file type
    if (!in_array($type, $supported)) {
        echo "Not a correct file type";
        exit();
    }

    // Ensure the uploaded file is an image
    if (!getimagesize($_FILES['image']['tmp_name'])) {
        echo "File is not an image";
        exit();
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        try {
            // Use prepared statements to insert into the database securely
            $db = new DB;
            $query = $db->connect()->prepare("INSERT INTO tbl_products (name, image) VALUES (:name, :image)");
            $query->bindParam(':name', $name);
            $query->bindParam(':image', $targetFile);
            $query->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error uploading file.";
    }
}

// Handle adding a new order
if (isset($_POST['add_order'])) {
    $user_id = (int)$_POST['user_id'];
    $total_price = (float)$_POST['total_price'];
    $order_status = validate_and_sanitize($_POST['order_status']);
    
    try {
        $db = new DB;
        $query = $db->connect()->prepare("INSERT INTO orders (user_id, total_price, order_status) VALUES (:user_id, :total_price, :order_status)");
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':total_price', $total_price, PDO::PARAM_STR);
        $query->bindParam(':order_status', $order_status, PDO::PARAM_STR);
        $query->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Handle updating an order's status
if (isset($_POST['update_order'])) {
    $order_id = (int)$_POST['order_id'];
    $order_status = validate_and_sanitize($_POST['order_status']);
    
    try {
        $db = new DB;
        $query = $db->connect()->prepare("UPDATE orders SET order_status = :order_status WHERE order_id = :order_id");
        $query->bindParam(':order_status', $order_status, PDO::PARAM_STR);
        $query->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $query->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}



// Fetch all orders
try {
    $db = new DB;
    $conn = $db->connect();
    if (!$conn) {
        throw new Exception('Database connection failed!');
    }
    $query = $conn->prepare("SELECT * FROM orders");
    $query->execute();
    $orders = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders & Products</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .container {
            background-color: #333333;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            color: white;
        }

        h2, h3 {
            text-align: center;
            color: white;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            background-color: orange;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: orange;
        }

        table tbody tr:nth-child(even) {
            background-color: orange;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        .actions a, .actions button {
            background-color: orangered;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions a {
            margin-left: 10px;
        }

        .actions button {
            border: none;
        }

        .actions select {
            padding: 6px;
            font-size: 14px;
            margin-right: 10px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class='navbar'>
    <div class='logo'> <img src='Images/mainlogo1.JPG'></div>
    <ul class='nav-list'>
        <li><a href='index.php'><i class='fa fa-fw fa-home'></i>HOME</a></li>
        <li><a href='loginn.php'><i class='fa fa-address-book'> </i> LOGIN</a></li>                    
        <li><a href='register.php'><i class='fa fa-sign-in'></i> ADMIN</a></li>
        <li><a href='logout.php'><i class='fa fa-sign-in'></i> Logout</a></li>
        <li><a href='basket.php'><img src='Images/basket.png' height='30px' width='30px'></a></li>
    </ul>
    <form action="search_results.php" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search Items" required>
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
</div>

<br><br><br><br><br><br><br>



<div class="container">
    <h2>All Orders</h2>
    <div style="margin-top: 20px; text-align: center;">
        <a href="basket.php" class="btn">Go to basket</a>
    </div>

    <?php if (isset($errorMessage) && !empty($errorMessage)): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($errorMessage); ?>
        </div>
    <?php endif; ?>

<br>
  

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Total Price</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                       </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<br><br>
<div class="footer">&copy;<span id="year"> </span><span> Your Company Name. All rights reserved.</span></div>

</body>
</html>
