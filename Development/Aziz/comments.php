<?php
$host = "213.171.200.36";
$username = "fahimaziz";
$password = "Password20*";
$dbname = "faziz";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the comment, username, and event name from the form
$comment = $_POST['comment'];
$eventname = $_POST['eventname'];


// Insert the comment, username, and event name into the database
$sql = "INSERT INTO comments (comment, eventname) VALUES ('$comment', '$eventname')";
if ($conn->query($sql) === TRUE) {
    // Redirect back to the event page after submitting the comment
    header("Location: events.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>