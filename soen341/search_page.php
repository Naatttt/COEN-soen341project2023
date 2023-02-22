<?php include 'timeout.php' ?>

<?php
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: sign_up_page.php");
    exit;
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
                        <a class="nav-link navbar-text" href="/soen341/index.php#about">
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
        
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "postings";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch all rows from the 'postings' table
            $sql = "SELECT * FROM postings";
            $result = $conn->query($sql);

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Output the rows in the desired format
                echo '<div style="text-align: center; padding-top: 3%;">';
                echo '<h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%">';
                echo 'Search Postings';
                echo '</h1>';
                echo '</div>';
                echo '<div style="background-color: white; height: 70%; margin: auto; width: 53%; overflow: scroll; text-align: center">';
                echo '<div class="table" style="margin: auto;">';
                echo '<div class="row header-row" style="position: sticky; top: 0; background-color: #333; z-index: 1; width: auto; margin: auto;">';
                echo '<div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Position</h3></div>';
                echo '<div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Company</h3></div>';
                echo '<div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Industry</h3></div>';
                echo '<div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Location</h3></div>';
                echo '<div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Salary</h3></div>';
                echo '</div>';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">';
                    echo '<a href="position.php?id=' . $row['id'] . '" style="display: contents">';
                    echo '<div class="cell" style="width: 200px"><p class="text-black">' . $row['position'] . '</p></div>';
                    echo '<div class="cell" style="width: 200px"><p class="text-black">' . $row['company'] . '</p></div>';
                    echo '<div class="cell" style="width: 200px"><p class="text-black">' . $row['industry'] . '</p></div>';
                    echo '<div class="cell" style="width: 200px"><p class="text-black">' . $row['plocation'] . '</p></div>';
                    echo '<div class="cell" style="width: 200px"><p class="text-black">' . $row['salary'] . '</p></div>';
                    echo '</a>';
                    echo '</div>';                    
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo "No rows found";
            }            

            $conn->close();
        ?>


</body>