<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Grid</title>
    <link rel="stylesheet" href="div.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .grid-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            transition: 2s;
        }

        .grid-item {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 30%;
            padding: 20px;
            box-sizing: border-box;
        }

        .grid-item h3 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .comment-section {
            margin-top: 20px;
            margin-right: 15%;
        }

        .comment-section h4 {
            margin-bottom: 10px;
        }

        .comment-section textarea {
            width: 100%;
            height: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }

        .comment-section button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .Search {
            background-color: #f2f2f2;
            width: 300px;
            margin-left: 40%;

        }

        .comments-section {
            margin-top: 20px;
        }

        .comments-section h4 {
            margin-bottom: 10px;
            color: #333;
            font-size: 1.5rem;
        }

        .comments-container {
            max-height: 200px;
            overflow-y: auto;
        }

        .comments {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .comments p {
            margin: 0;
            font-size: 1.1rem;
            color: #555;
        }

        .footer {
            position: relative;
            width: 100%;
            background: black;
            min-height: 100px;
            padding: 20px 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #6eea8e;
        }

        .social-icon,
        .menu {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .social-icon__item,
        .menu__item {
            list-style: none;
        }

        .social-icon__link {
            font-size: 2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
        }

        .social-icon__link:hover {
            transform: translateY(-10px);
        }

        .menu__link {
            font-size: 1.2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
            text-decoration: none;
            opacity: 0.75;
            font-weight: 300;
        }

        .menu__link:hover {
            opacity: 1;
        }

        .footer p {
            color: #fff;
            margin: 15px 0 10px 0;
            font-size: 1rem;
            font-weight: 300;
        }

        .see-comments {
            background-color: #f2f2f2;
        }

        .see-comments-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }

        .see-comments-button:hover {
            background-color: #45a049;
            /* Darken the background color on hover */
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
        <div class="Logout"> </div>
        <button type="button" class="button" id="addToCart" onclick="redirect(indexx.php)">
            <a href=login.php>Logout</a>
        </button>
    </div>
    <div class="Search">
        <center><br> <b>Search by name or date</b>
            <form action="events.php" method="GET">
                <input type="text" placeholder="Search events by name..." name="search"><b>OR</b>
                <input type="date" name="date">
                <button type="submit">Search</button>
            </form>
        </center>
        </form>
    </div>

    <?php
    $host = "213.171.200.36";
    $username = "fahimaziz";
    $password = "Password20*";
    $dbname = "faziz";
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['search']) || isset($_GET['date'])) {
        // Check if either the search query or the date is provided
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $date = isset($_GET['date']) ? $_GET['date'] : '';

        if (!empty($search) && !empty($date)) {
            // If both search query and date are provided
            $query = "SELECT * FROM Events WHERE (Events LIKE '%$search%' OR Date LIKE '%$search%') AND Date = '$date'";
        } elseif (!empty($search)) {
            // If only the search query is provided
            $query = "SELECT * FROM Events WHERE Events LIKE '%$search%' OR Date LIKE '%$search%'";
        } elseif (!empty($date)) {
            // If only the date is provided
            $query = "SELECT * FROM Events WHERE Date = '$date'";
        } else {
            // If no search query or date is provided, fetch all events
            $query = "SELECT * FROM Events";
        }

        $result = mysqli_query($conn, $query);

        if (!$result) {
            // Error handling for database query
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // If neither the search query nor the date is provided, fetch all events
        $query = "SELECT * FROM Events";
        $result = mysqli_query($conn, $query);
    }

    if ($result_comments->num_rows > 0) {
        echo '<div class="comments-section">';
        echo '<h4>Comments:</h4>';
        echo '<div class="comments-container">'; // Comments container for scrolling
        while ($comment_row = $result_comments->fetch_assoc()) {
            echo '<div class="comments">';
            echo '<p>' . $comment_row['comments'] . '</p>';
            echo '</div>';
        }
        echo '</div>'; // Close comments-container div
        echo '</div>'; // Close comments-section div
    } else {
        echo '<div class="comments-section">';

        echo '</div>';
    }
    // Retrieve comments from the database
    $comments_query = "SELECT * FROM comments";
    $comments_result = mysqli_query($conn, $comments_query);



    ?>
    </div>


    <div class="grid-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="grid-item">';
                echo '<h3>' . htmlspecialchars($row['Events']) . '</h3>';
                echo '<p><strong>Location:</strong> ' . htmlspecialchars($row['Location']) . '</p>';
                echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['Date']) . '</p>';
                echo '<p><strong>Details:</strong> ' . htmlspecialchars($row['Details']) . '</p>';
                echo '<div class="comment-section">';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p></p>';
        }
        $conn->close();
        ?>
    </div>
    <div class="seecommnets">

        <?php // Form for submitting comments
        echo '<div style="text-align: center;"><h4>Leave a comment:</h4></div>';
        echo '<div class="comment-section">';
        echo '<form action="comments.php" method="post">';

        echo '<textarea name="comment" placeholder="Write your comment here with event name..."></textarea>';
        echo '<input type="hidden" name="event_id" value="' . $row['id'] . '">';
        echo '<button type="submit">Submit</button>';
        echo '</form>';
        ?>
        <center><button type="button" class="button see-comments-button" onclick="redirect(section.php)">
                <a href="section.php">
                    See all other Comments </a>
            </button></center>

    </div>
    </div>
    <br><br><br><br>
    <footer class="footer">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link"
                    href="https://en-gb.facebook.com/NewcastleCityCouncil/">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="https://x.com/NewcastleCC">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>

            <li class="social-icon__item"><a class="social-icon__link"
                    href="https://www.youtube.com/user/NewcastleCCUK">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="indexx.php">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="login.php">Events</a></li>
            <li class="menu__item"><a class="menu__link" href="signin.php">Sign in</a></li>


        </ul>
        <p>&copy;2024 Local Community | All Rights Reserved</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>