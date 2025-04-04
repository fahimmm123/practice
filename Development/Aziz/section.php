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
    <center>
        <h1>All the comments</h1>
    </center>
    <style>
        .comments-section {
            margin-top: 20px;
        }

        .comments-section h4 {
            margin-bottom: 10px;
            color: #f2f2f2;
            font-size: 1.5rem;
        }

        .comments-container {
            max-height: 200px;
            overflow-y: auto;
        }

        .comments {
            background-color: #f2f2f2;
            border-radius: 5px #4CAF50;
            padding: 10px;
            margin-bottom: 10px;
        }

        .comments p {
            margin: 0;
            font-size: 1.1rem;

        }
    </style>
</body>

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
        echo '<p><strong>Event:</strong> ' . htmlspecialchars($comment_row['eventname']) . '</p>';
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

// Display comments
if ($comments_result->num_rows > 0) {
    while ($comment_row = $comments_result->fetch_assoc()) {
        echo '<div class="comments">';
        echo '<p>' . htmlspecialchars($comment_row['comment']) . '</p>';
        echo '</div>';
    }
} else {
    echo '</p>';
}
// Retrieve comments from the database
$comments_query = $comments_query = "SELECT comments.comment, comments.eventname
FROM comments";
$comments_result = mysqli_query($conn, $comments_query);

// Check if the query executed successfully
if (!$comments_result) {
    // Error handling for database query
    echo "Error: " . mysqli_error($conn);
} else {
    // Display the number of comments fetched
    echo "Number of comments fetched: " . $comments_result->num_rows;
}

?>