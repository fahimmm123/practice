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
        /* Styling the form */
        .form-container {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #388E3C;
        }

        label {
            font-size: 1.1em;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #388E3C;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #81C784;
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
        <p>Fill out the form below to get in touch or share your feedback:</p>

        <!-- Form Container -->
        <div class="form-container">
            <h3>Contact Form</h3>
            <form action="submit_form.php" method="post">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="message"> Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <input type="submit" value="Submit">
            </form>
        </div>
    </main>

    <footer>
        &copy; 2024 My Website. All rights reserved.
    </footer>

</body>
</html>
