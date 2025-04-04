<?php
$host = "213.171.200.36";
$username = "fahimaziz";
$password = "Password20*";
$dbname = "faziz";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_POST['delete'])) {
    $id_to_delete = $_POST['event_id'];
    $delete_query = "DELETE FROM Events WHERE ID = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id_to_delete);
    $stmt->execute();
    $stmt->close();
}

// Handle update request
if (isset($_POST['update'])) {
    $id = $_POST['event_id'];
    $event = $_POST['event'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $details = $_POST['details'];

    $update_query = "UPDATE Events SET Events = ?, Location = ?, Date = ?, Details = ? WHERE ID = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $event, $location, $date, $details, $id);
    $stmt->execute();
    $stmt->close();
}

// Handle upload request

// Fetch all events
$query = "SELECT * FROM Events";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="div.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .edit-form {
            display: none;
            margin-top: 20px;
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
    </div>



    <?php
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Event</th><th>Location</th><th>Date</th><th>Event Detail</th><th>Edit</th><th>Delete</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['Events'] . '</td>';
            echo '<td>' . $row['Location'] . '</td>';
            echo '<td>' . $row['Date'] . '</td>';
            echo '<td>' . $row['Details'] . '</td>';
            echo '<td><button onclick="editEvent(' . $row['ID'] . ', \'' . addslashes($row['Events']) . '\', \'' . addslashes($row['Location']) . '\', \'' . $row['Date'] . '\', \'' . addslashes($row['Details']) . '\')">Edit</button></td>';
            echo '<td><form method="POST" style="display:inline-block;">
                        <input type="hidden" name="event_id" value="' . $row['ID'] . '">
                        <button type="submit" name="delete">Delete</button>
                  </form></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No events found.';
    }

    $conn->close();
    ?>

    <div class="edit-form" id="editForm">
        <h2>Edit Event</h2>
        <form method="POST">
            <input type="hidden" name="event_id" id="eventId">
            <label for="event">Event:</label>
            <input type="text" id="event" name="event"><br><br>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location"><br><br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date"><br><br>
            <label for="details">Event Details:</label>
            <textarea id="details" name="details"></textarea><br><br>
            <button type="submit" name="update">Update</button>
            <button type="button" onclick="hideEditForm()">Cancel</button>
        </form>
    </div>

    <script>
        function editEvent(id, event, location, date, details) {
            document.getElementById('eventId').value = id;
            document.getElementById('event').value = event;
            document.getElementById('location').value = location;
            document.getElementById('date').value = date;
            document.getElementById('details').value = details;
            document.getElementById('editForm').style.display = 'block';
            window.scrollTo(0, document.getElementById('editForm').offsetTop);
        }

        function hideEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }
    </script>
    <br><br><br><br>


</body>

</html>