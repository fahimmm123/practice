<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENTS</title>
    <link rel="stylesheet" href="div.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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
    </style>
    <script>
        // Check if the error message div is empty
        window.onload = function () {
            var errorMessage = document.getElementById('errorMessage');
            if (errorMessage.innerHTML === "") {
                errorMessage.style.display = "none"; // Hide the error message div
            }
        };
    </script>
</head>

<body>

    <div class="main">
        <h1>Please LOG IN to see all the events</h1>
        <h3>Enter a username and password</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="register">
            <label for="first">Username:</label>
            <input type="text" id="first" name="username" placeholder="Enter your Username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            <div class="wrap">
                <button type="submit" class="button" id="checkCredentials" name="checkCredentials">Check
                    Credentials</button>
            </div>
            <!-- Error message div -->
            <div id="errorMessage" style="color: red;"></div>
        </form>
        <p> Not signed in yet? <a href="signin.php" style="text-decoration: none;">Signin</a></p>
        <div class="mainleft">
            <img src="Images/aa.jfif" height="400px" width="500">
        </div>
    </div>


    <br><br><br><br><br>


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

    // Check if form is submitted and process the data
    if (isset($_POST['checkCredentials'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM registration WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, redirect to events.php
            header("Location: events.php");
            exit();
        } else {
            // User doesn't exist, display an error message
            echo "<script>document.getElementById('errorMessage').innerHTML = 'Invalid username or password';</script>";
        }
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>


</body>

</html>