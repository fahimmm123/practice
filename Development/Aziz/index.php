<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="div.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>




<style>
    *

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {

        .prev,
        .next,
        .text {
            font-size: 11px
        }
    }

    .numbertext1 {
        font-size: 40px;
        align: left;
    }

    /*style.css*/
    .Sagar {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: sans-serif;
        line-height: 1.5;
        min-height: 100vh;
        background: #f3f3f3;
        flex-direction: column;
        margin: 0;
    }

    .main {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        padding: 10px 20px;
        transition: transform 0.2s;
        width: 500px;
        text-align: center;
    }

    h1 {
        color: #4CAF50;
    }

    label {
        display: block;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 5px;
        text-align: left;
        color: #555;
        font-weight: bold;
    }


    input {
        display: block;
        width: 100%;
        margin-bottom: 15px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .button1 {
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        border: none;
        color: white;
        cursor: pointer;
        background-color: #4CAF50;
        width: 100%;
        font-size: 16px;
    }

    .wrap {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
</head>








<body>
    <div class="topnav">
        <a href="home"></i>Newcastle City Council </a>
        <a class="active" href="home"><i class="fa fa-fw fa-home"></i><i class="fa-solid fa-house"></i>Home</a>
        <a href="about"><i class="fa fa-address-book" aria-hidden="true"></i>Events</a>
        <a href="login"><i class="fa fa-sign-in" aria-hidden="true"></i></i>Login</a>
        <div class="login"> <button type="button" class="button" id="addToCart" onclick="redirect(contact.html)">
                <a href=Contact.html>LOGIN</a> </button></div>
    </div>
    <div class="main">
        >

        <h1>Register</h1>
        <h3>Enter your details</h3>
        <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="register">
            <label for="first">
                Username:
            </label>
            <input type="username" id="first" name="username" placeholder="Enter your Username" required>

            <label for="sfga">
                First Name:
            </label>
            <input type="firstname" id="first" name="username" placeholder="Enter your Username" required>

            <label for="password">
                Password:
            </label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>

            <div class="wrap">
                <button class="button button1" type="submit" onclick="solve()">
                    Submit
                </button>
            </div>
        </form>
        <p>Not registered?
            <a href="#" style="text-decoration: none;">
                Create an account
            </a>
        </p>
    </div>
</body>

</html>


<?php
// Connection (Improved with Prepared Statements)
$host = "213.171.200.36";
$username = "fahimaziz";
$password = "Password20*";
$dbname = "faziz";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted and use prepared statements for security
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);  // Escape user input
    $password = mysqli_real_escape_string($conn, $_POST['password']);  // Escape user input

    // Prepare the SQL statement (prevents SQL injection)
    $sql = "INSERT INTO registration (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind values to the prepared statement (improves security)
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration was successful.";
    } else {
        echo "Error: " . $stmt->error; // Use stmt->error instead of mysqli_error
    }

    // Close the prepared statement
    $stmt->close();
}

// Close connection
$conn->close();
?>





</div>

<br>
<div <br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="footer">

        <center>
            <h1><br>Local Council</h1>
            <br>
            Email : Localcouncil@outlook.com<br>
            Address: 1 Wagon way, Newcastle Upon Tyne, NE98 1TH<br><br>

        </center>

        </html>