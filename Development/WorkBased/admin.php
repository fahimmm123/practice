<?php
session_start();

require "DB.php"; // Include the database connection
$db = new DB;

$errorMessage = ''; // Initialize an empty error message

// CSRF token implementation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a CSRF token
}

// If already logged in, redirect to create.php
if (isset($_SESSION['username'])) {
    header("Location: create.php");
    exit();
}

// Process login when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token.");
    }

    // Get the username and password from POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $errorMessage = 'Please enter both username and password.';
    } else {
        // Connect to the database
        $conn = $db->connect();
        if (!$conn) {
            $errorMessage = 'Database connection failed!';
        } else {
            // Prepare a query to fetch the admin with the provided username
            $query = $conn->prepare("SELECT * FROM admin WHERE username = :username");
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->execute();

            // If the admin exists, check the password
            if ($query->rowCount() > 0) {
                $user = $query->fetch(PDO::FETCH_ASSOC);

                // Compare the provided password with the stored password
                if ($password == $user['password']) { // Here, plain text comparison is assumed
                    // Password is correct, log the user in by setting a session variable
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    // Regenerate session ID to prevent session fixation attacks
                    session_regenerate_id(true);

                    // Redirect to the create.php page
                    header("Location: create.php");
                    exit();
                } else {
                    $errorMessage = 'Login information did not match.';
                }
            } else {
                $errorMessage = 'Login information did not match.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Permanent+Marker&display=swap" rel="stylesheet">
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
        <form action="search_results.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search Items " required>
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
    </div>
    <div id="login">
        <h1>Admin Login</h1>
        <form method="POST" autocomplete="off">
            <span class="fontawesome-user"></span>
            <input type="text" id="user" name="username" placeholder="Username" required autocomplete="off">
            <span class="fontawesome-lock"></span>
            <input type="password" id="pass" name="password" placeholder="Password" required autocomplete="new-password">
            <!-- CSRF Token hidden field -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <input type="submit" value="Login">
        </form>
        
        <!-- Display error message if credentials are incorrect -->
        <?php if (!empty($errorMessage)): ?>
            <div style="color: red; margin-top: 10px;">
                <?php echo htmlspecialchars($errorMessage); // Sanitize output ?>
            </div>
        <?php endif; ?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="footer">&copy;<span id="year"> </span><span> Your Company Name. All rights reserved.</span></div>

</body>
</html>
