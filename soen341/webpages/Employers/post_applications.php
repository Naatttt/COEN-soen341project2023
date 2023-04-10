<?php include '../../DB_PASSWORD.php' ?>
<?php include '../Homepage/BACK_timeout.php'?>

<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", DB_PASSWORD, "users");

// Retrieve the user's name from the database
$username = $_SESSION['username'];
$query = "SELECT usertype, name, username, company FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the query result and get the name value
    $row = $result->fetch_assoc();
    $usertype = $row['usertype'];
    $name = $row['name'];
    $company = $row['company'];
} else {
    // Display an error message if the query failed
    $name = "Error: " . $mysqli->error;
}

if($usertype == 'employee') {
    header("Location: ../Students/dashboard.php");
    exit();
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
        <link rel="icon" href="/soen341/images/favicon.ico">

        <!-- Linking font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    </head>

    <body class="background-image">
        <?php include '../Navbar/navbar.php' ?>
        
        <?php

            // Create connection
            $conn_postings = new mysqli("localhost", "root", DB_PASSWORD, "postings");

            // Check connection
            if ($conn_postings->connect_error) {
                die("Connection failed: " . $conn_postings->connect_error);
            }
            if (!isset($_GET["query"])) {
                $query = "SELECT id FROM postings WHERE company = '$company'";
            } else if (isset($_GET["query"])) {
                $query = urldecode($_GET["query"]);
            }
            
            // Execute the query and store the result in $ids
            $result = $conn_postings->query($query);
            
            // Convert the result set to an array of IDs
            $ids = array();
            while ($row = $result->fetch_assoc()) {
                $ids[] = $row["id"];
            }
            
            // Create connection to applications database
            $conn_applications = new mysqli("localhost", "root", DB_PASSWORD, "applications");
            
            // Check connection
            if ($conn_applications->connect_error) {
                die("Connection failed: " . $conn_applications->connect_error);
            }
            
            // Build the second query using the array of IDs
            $id_list = implode(",", $ids);
            $query2 = "SELECT * FROM applications WHERE postingid IN ($id_list)";
            
            // Execute the second query and store the result in $applications
            $applications = $conn_applications->query($query2);

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Output the rows in the desired format
                echo '<div class="d-flex justify-content-between align-items-center" style="margin-top: 2%">';
                echo '<a class="btn btn-light btn-lg outer2" style="margin-left: 12.5%; width: 200px" id="search-btn">Postings Filter</a>';
                echo '<h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%; margin-left: 13.5%">' . $company . ' Postings</h1>';
                echo '<a href="/soen341/webpages/Employers/employer_postings.php" class="btn btn-light btn-lg outer2" style="margin-right: 12.5%; width: 200px">Reset Filter</a>';
                echo '</div>';
                echo '<div style="background-color: white; height: 70%; margin: auto; width: 80%; overflow: scroll; text-align: center">';
                echo '<div class="table" style="margin: auto;">';
                echo '<div class="row header-row" style="position: sticky; top: 0; background-color: #333; z-index: 1; width: auto; margin: auto;">';
                echo '<div class="cell" style="width: 100px"><h3 class="text-white postings-size" style="font-size: 1.5em">Id</h3></div>';
                echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Position</h3></div>';
                echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Industry</h3></div>';
                if ($query === "SELECT * FROM postings ORDER BY plocation DESC") {
                    $location_label = "Location ▼";
                } else if ($query === "SELECT * FROM postings ORDER BY plocation ASC") {
                    $location_label = "Location ▲";
                } else {
                    $location_label = "Location";
                }
                echo '<div class="cell" style="width: 300px"><button style="border: none" onclick="refreshPage()"><h3 class="text-white postings-size" style="font-size: 1.5em" id="location-btn" onclick="changeSalary()">' . $location_label . '</h3></button></div>';                
                if ($query === "SELECT * FROM postings ORDER BY salary DESC") {
                    $salary_label = "Salary ▼";
                } else if ($query === "SELECT * FROM postings ORDER BY salary ASC") {
                    $salary_label = "Salary ▲";
                } else {
                    $salary_label = "Salary";
                }
                echo '<div class="cell" style="width: 200px"><button style="border: none" onclick="refreshPage()"><h3 class="text-white postings-size" style="font-size: 1.5em" id="salary-btn" onclick="changeSalary()">' . $salary_label . '</h3></button></div>';
                echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Edit</h3></div>';
                echo '</div>';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">';
                    echo '<a href="post_applications.php?id=' . $row['id'] . '" style="display: contents">';
                    echo '<div class="cell" style="width: 100px"><h3 class=" postings-size">' . $row['id'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['position'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['industry'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['plocation'] . '</h3></div>';
                    echo '<div class="cell" style="width: 200px"><h3 class=" postings-size">' . $row['salary'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><a href="position_info.php?id=' . $row['id'] . '" class="btn btn-primary btn-lg outer postings-size" style="width: 200px; background: #007bff">Info</a></div>';
                    echo '</a>';
                    echo '</div>';                    
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="d-flex flex-column align-items-center" style="margin-top: 2%">';
                echo '<h1 class="text-white text-center" style="font-size: 2vw; margin-top: 10%">  Your company, '.$company.', has not yet posted any positions</h1>';
                echo '<a href="post.php" class="btn btn-primary btn-lg outer" style="margin-top: 10%; height: 100px; width: 500px; display: flex; justify-content: center; align-items: center;">Post Your First Position</a>';
                echo '</div>';
            }
            // Close the connection to postings database
            $conn_postings->close();
            // Close the connection to applications database
            $conn_applications->close();

        ?>

    </body>
</html>