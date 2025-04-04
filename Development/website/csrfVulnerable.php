<?php
require 'DB.php';
ini_set('display_errors', 1);

session_start();

$db = new DB;
$_SESSION['account'] = 12345678; // Assuming the account number is hard-coded for testing.
$account = $_SESSION['account'];

// Check if session token is not set, then generate it
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32)); // Correct session token name
}

$query = $db->connect()->prepare("SELECT balance FROM 214_accounts WHERE account = :account");
$query->bindParam(':account', $account, PDO::PARAM_INT);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $balance = $row['balance'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the CSRF token from the POST request
    $token = htmlspecialchars($_POST['token']);

    // Check if the token is missing or doesn't match the session token
    if (empty($token) || $token !== $_SESSION['token']) {
        echo "Invalid CSRF token";
        exit;
    } else {
        $amount = $_POST['amount'];
        $target = $_POST['targetAccount'];

        // Calculate new balance for the origin account
        $originNewBalance = $balance - $amount;

        // Get the target account balance
        $query = $db->connect()->prepare("SELECT balance FROM 214_accounts WHERE account = :target");
        $query->bindParam(':target', $target, PDO::PARAM_INT);
        $query->execute();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $targetBalance = $row['balance'];
        }

        // Calculate new balance for the target account
        $targetNewBalance = $targetBalance + $amount;

        // Update the balances for both accounts
        $query = $db->connect()->prepare("UPDATE 214_accounts SET balance = :newBalance WHERE account = :account");
        $query->execute(array(':newBalance' => $originNewBalance, ':account' => $account));

        $query = $db->connect()->prepare("UPDATE 214_accounts SET balance = :targetBalance WHERE account = :target");
        $query->execute(array(':targetBalance' => $targetNewBalance, ':target' => $target));

        // Regenerate the token after a successful transaction
        $_SESSION['token'] = bin2hex(random_bytes(32));

        // Redirect after successful transfer
        header('Location: csrfVulnerable.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Transfer</title>
</head>

<body>
    <h2>Super Secure Bank</h2>
    <h2>Current Balance £<?= $balance ?></h2>

    <form method="POST">
        <label for="amount">Amount to transfer</label><br>
        <input type="text" id="amount" name="amount"><br>
        <label for="targetAccount">Payee Account</label><br>
        <input type="text" id="targetAccount" name="targetAccount"><br>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>"> <!-- CSRF Token -->
        <input type="submit" id="submit" name="submit" value="Transfer"><br>
    </form>
</body>

</html>
