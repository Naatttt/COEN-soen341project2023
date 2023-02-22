<?php include 'timeout.php' ?>

<?php
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: sign_up_page.php");
    exit;
}
?>

<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "users");

// Retrieve the user's name from the database
$username = $_SESSION['username'];
$query = "SELECT name, username, education, mylocation FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the query result and get the name value
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $education = $row['education'];
    $mylocation = $row['mylocation'];
} else {
    // Display an error message if the query failed
    $name = "Error: " . $mysqli->error;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TalentHub</title>


        <!-- Linking bootstrap framework-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <!-- Linking css file and favicon-->
        <link rel="stylesheet" href="/soen341/css/style.css">
        <link rel="icon" href="favicon.ico">

        <!-- Linking font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    </head>

    <body class="background-image">
         <!-- Navigation Bar (top)-->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">

            <a class="navbar-brand summon-font" href="/soen341/index.php" style="margin-left: 16px;">
                <h1 class="brand-name" style="margin: auto;">
                    TalentHub
                </h1>
            </a>

            <!-- Dynamic Button for mobile/small screen-->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: 20px;">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Elements in navbar-->
            <div class="collapse navbar-collapse summon-font" id="navbarSupportedContent">
                 <ul class="navbar-nav ms-auto" style="margin-right: 20px; font-size: 21px;">
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/index.php/#about">
                            About
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbar-text" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Search
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item navbar-text" href="/soen341/search_page.php" style="color: #212529">
                                    Find Opportunities
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item navbar-text" href="#" style="color: #212529">
                                    Open a Position
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/dashboard.php">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/log_out.php">
                        <?php
                                // Check if the user is logged in
                                if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                                    $h1_text = "Sign In";
                                }
                                else {
                                    $h1_text = "Sign Out";
                                }
                            echo $h1_text; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        
        <div style="text-align: center; padding-top: 3%;">
            <h1 class="text-white" style="font-size: 4vw;">
                Welcome, <?php echo $name; ?>!
            </h1>
            <h3 class="text-white" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                Let's get started.
            </h3>
        </div>

        <div class="profile_buttons">
            <a href="/soen341/search_page.php" class="btn btn-primary btn-lg outer" style="margin-right: 5%; width: 200px">Search</a>
            <a href="/soen341/update_profile.php" class="btn btn-light btn-lg outer2" style="margin-left: 5%; width: 200px">Update Profile</a>
        </div>

        <!-- Start of Page Here-->
        <div class="table" style="margin: auto; margin-top: 3%; text-align: center">
            <div class="row" style="width: 800px; margin: auto; text-align: center">
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 2vw">Name</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 2vw">Username</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 2vw">Education</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 2vw">Location</h3></div>
            </div>
            <div class="row" style="width: 800px; margin: auto; text-align: center">
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $name ?></h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $username ?></h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $education ?></h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $mylocation ?></h3></div>
            </div>

            <hr>
            
            <?php include 'display_pdf.php' ?>
        </div>
    </body>
</html>