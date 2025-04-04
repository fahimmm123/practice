<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Web Page with PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightgrey; /* Soft light blue */
        }
        header {
            background-color: #388E3C; /* A darker shade of green */
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 2em;
        }
        nav {
            background-color: #2C6B2F; /* Dark green for consistency with header */
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #81C784; /* Lighter green when hovered */
            color: black;
        }
        main {
            padding: 20px;
            font-size: 1.2em;
        }
        footer {
            background-color: #2C6B2F; /* Matching footer with nav */
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        h2, p {
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        My Basic Web Page
    </header>

    <nav>
        <a href="#home">Home</a>
        <a href="CPDpractice.php">Practice</a>
        <a href="formCPD.php">Form</a>
        <a href="#contact">Contact</a>
    </nav>

    <main>
        <h2>Welcome to My Web Page</h2>
           <?php
            // Basic PHP example with if statements
            $hour = date("H"); // Get the current hour
            if ($hour < 12) {
                echo "<p>Good morning! It's {$hour} AM.</p>";
            } elseif ($hour < 18) {
                echo "<p>Good afternoon! It's {$hour} PM.</p>";
            } else {
                echo "<p>Good evening! It's {$hour} PM.</p>";
            }
            // Using arithmetic operators
            $num1 = 10;
            $num2 = 5;
            $sum = $num1 + $num2;
            $difference = $num1 - $num2;
            $product = $num1 * $num2;
            $quotient = $num1 / $num2;
            $remainder = $num1 % $num2;
            echo "<p>Let's do some math!</p>";
            echo "<p>Sum: {$num1} + {$num2} = {$sum}</p>";
            echo "<p>Difference: {$num1} - {$num2} = {$difference}</p>";
            echo "<p>Product: {$num1} * {$num2} = {$product}</p>";
            echo "<p>Quotient: {$num1} / {$num2} = {$quotient}</p>";
            echo "<p>Remainder: {$num1} % {$num2} = {$remainder}</p>";

            // Using a loop
            echo "<p>Loop Example: Counting from 1 to 5:</p>";
            for ($i = 1; $i <= 5; $i++) {
                echo "<p>Number: {$i}</p>";
            }

            // Using a while loop
            echo "<p>While Loop Example: Counting down from 5:</p>";
            $count = 5;
            while ($count > 0) {
                echo "<p>Countdown: {$count}</p>";
                $count--;
            }
        ?>

    </main>

    <footer>
        &copy; 2024 My Website. All rights reserved.
    </footer>

</body>
</html>
