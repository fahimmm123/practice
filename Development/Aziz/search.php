<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    // check if the form is submitted
    
    $host = "213.171.200.36";
    $username = "fahimaziz";
    $password = "Password20*";
    $dbname = "faziz";
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST['search']) && !empty($_POST['search'])) {
        // Get the search query from the form
        $search = $_POST['search'];

        // Perform the search query
        $query = "SELECT * FROM events WHERE events LIKE '%$search%' OR date LIKE '%$search%'";
        $result = mysqli_query($conn, $query);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // Display the search results
            while ($row = mysqli_fetch_assoc($result)) {
                // Output each search result within a styled box
                echo "<div class='event-box'>";
                echo "<div class='event'>";
                echo "<h2>" . $row['events'] . "</h2>";
                echo "<p>Date: " . $row['date'] . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // If no results found, display a message
            echo "<div class='event-box'>";
            echo "<p>No events found matching your search.</p>";
            echo "</div>";
        }
    } else {
        // If search input is empty, display a message
        echo "<div class='event-box'>";
        echo "<p>Please enter a search query.</p>";
        echo "</div>";
    }
    ?>
</body>

</html>