<?php
// Retrieve the username and password values from the login form
$username = $_POST['inputusername'];
$password = $_POST['inputpassword'];

// Validate the username and password values
if (empty($username) || empty($password)) {
  // Display an error message and exit the script
  echo "Username and password are required";
  exit;
}

// Connect to the MySQL database
$mysqli = new mysqli("localhost", "root", "", "users");

// Query the database to retrieve the user's record
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($query);


if ($result->num_rows == 1) {
  // If a record is found, compare the hashed password with the hashed version of the password provided by the user
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    echo "log in successful";
    // If the passwords match, log the user in to your website
    session_start();

    // Set the session timestamp
    if (!isset($_SESSION['timestamp'])) {
      $_SESSION['timestamp'] = time();
    }

    $_SESSION['username'] = $username;
    $_SESSION['loggedin'] = true;
    
    // Redirect the user to the dashboard or home page
    header("Location: dashboard.php");
    exit;
  }
}

// If the script reaches this point, the user has provided incorrect login credentials
echo "Invalid username or password";
?>
