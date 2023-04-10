<?php include '../../DB_PASSWORD.php' ?>

<?php

$conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET["appid"])){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "UPDATE applications SET selected = 1 WHERE app_id =" . urldecode($_GET["appid"]);
        if ($conn->query($sql) === TRUE) {
            echo "Column value updated successfully";
        }
        else {
            echo "Error updating column value: " . $conn->error;
        }
    }
}

$conn->close();

// Redirect back to dashboard
header("Location: employer_dashboard.php");
exit;
?>