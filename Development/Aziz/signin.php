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
        width: 800px;
        text-align: center;
        margin-left: 500px;
        margin-top: 50px;

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

    body {
        background-color: rgb(255, 255, 255);
        height: 1200px;

    }



    text-decoration: {
        overline rgb(62, 227, 17);
        transition: 300ms;

    }






    .Volkswagentext {

        text-align: center;
    }

    button {
        background-color: rgb(17, 228, 154);
        color: white;
        border: none;
        border-radius: 1px;
        padding: 0px;
        font-size: 14px;
        font-weight: 300;
        cursor: pointer;
        margin-bottom: 0px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        text-decoration: none;
    }



    .text123 {
        color: white;
        background-color: #4fd690;
        padding: 15px;
        text-decoration: none;
    }

    .abcd {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
        margin-top: 10%;
        margin-left: 7%;
    }

    .abcd1 {
        font-size: 14px;
    }

    .lease {
        background-color: rgb(24, 22, 20);
        align: center;
    }

    .orange {
        background-color: rgb(227, 151, 11);
        margin: 5%;
        s border-radius: 25px;
    }

    .grid-containeraaron {
        display: grid;
        grid-template-columns: auto auto auto;
        background-color: #000000;
        padding: 10px;
        border: 1px solid rgba(219, 104, 10, 0.8);

    }

    .grid-itemaaron {
        background-color: rgba(0, 0, 0, 0.8);

        padding: 20px;

        text-align: center;

    }

    p {
        font-family: verdana;

    }

    .next {
        color: #000;
    }

    .topnav {
        overflow: hidden;
        background-color: #000000;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
        float: left;
        display: block;
        color: rgb(255, 255, 255);
        text-align: center;
        padding: 14px 46px;
        text-decoration: none;
        font-size: 20px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: rgb(17, 228, 154);
        color: rgb(43, 158, 64);
    }

    /* Style the "active" element to highlight the current page */
    .topnav a.active {
        background-color: #4fd690;
        color: rgb(14, 178, 27);
    }

    /* Style the search box inside the navigation bar */
    .login {
        float: right;
        padding: 0px;
        border: none;
        margin-top: 0px;
        margin-right: 20px;
        margin-left: 20px;
        font-size: 14px;

    }

    .topnav i {
        margin-right: 8px;
    }

    /* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
    @media screen and (max-width: 600px) {

        .topnav a,
        .topnav input[type=text] {
            float: none;
            display: block;
            text-align: left;
            width: 100%;
            margin: 0;
            padding: 14px;
        }

        .topnav input[type=text] {
            border: 1px solid #000000;
        }

        .mainleft {
            float: left;
        }


    }
</style>
</head>








<body>
    <div class="topnav">
        <a class="indexx.php" href="indexx.php"><i class="fa fa-fw fa-home"></i><i
                class="fa-solid fa-house"></i>Home</a>
        <a href="login.php"><i class="fa fa-address-book" aria-hidden="true"></i>Events</a>
        <a href="signin.php"><i class="fa fa-sign-in" aria-hidden="true"></i></i>Sign in</a>
        <a href="adlogin.php"><i class="fa fa-sign-in" aria-hidden="true"></i></i>Admin</a>
        <div class="login"> <button type="button" class="button" id="addToCart" onclick="redirect(login.php)">
                <a href=login.php>LOGIN</a> </button></div>
    </div>

    <div class="main">

        <h1>Register</h1>
        <h3>Enter a username and password</h3>
        <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="register">
            <label for="first">
                First Name
            </label>


            <input type="firstname" id="first" name="firstname" placeholder="Enter your firstame" required>

            <label for="first">
                Surname:
            </label>
            <input type="surname" id="username" name="surname" placeholder="Enter your surname" required>

            <label for="first">
                Username:
            </label>
            <input type="username" id="first" name="username" placeholder="Enter your Username" required>


            <label for="email">
                Email:
            </label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

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
        <p>registered already?
            <a href="#" style="text-decoration: none;">
                Login
            </a>
        </p>
        <div class="mainleft">
            <img src="Images/aa.jfif" alt="">
        </div>
</body>
</div><br><br><br><br>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']); // Escape user input
    $surname = mysqli_real_escape_string($conn, $_POST['surname']); // Escape user input
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Escape user input
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Escape user input
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Escape user input

    // Check if email contains '@'
    if (strpos($email, '@') === false) {
        echo "Email must contain '@'.";
    } else {
        // Prepare the SQL statement (prevents SQL injection)
        $sql = "INSERT INTO registration (firstname, surname, username, password, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind values to the prepared statement (improves security)
        $stmt->bind_param("sssss", $firstname, $surname, $username, $password, $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Registration was successful.</p>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }
}

// Retrieve first name from database
$sql = "SELECT firstname FROM your_table_name"; // Update your_table_name with the actual table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "First Name: " . $row["firstname"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>