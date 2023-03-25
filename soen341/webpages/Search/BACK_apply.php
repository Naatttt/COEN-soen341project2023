<?php include '../../DB_PASSWORD.php' ?>

<?php

// Start the session to store any error messages
session_start();

// Get the form data
$postingid = $_POST['id'];
$student = $_SESSION['username'];

// Connect to the MySQL database
$conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");
$conn_postings = new mysqli('localhost', 'root', DB_PASSWORD, 'postings');

// Retrieve the posting id
$sql = "SELECT * FROM postings WHERE id = '$postingid'";
$result = $conn_postings->query($sql);

$query = "SELECT MAX(id) AS max_id FROM applications";
$result1 = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result1);
$next_id = $row['max_id'] + 1;

$sql2 = "INSERT INTO applications (id, postingid, student) VALUES ('$next_id', '$postingid', '$student')";
    if ($conn->query($sql2) === TRUE) {
        echo "Application submitted successfully";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }


// Close connection
$conn->close();
$conn_postings->close();
?>