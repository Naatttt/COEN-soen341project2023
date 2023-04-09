<?php include '../../DB_PASSWORD.php' ?>
<?php include '../Navbar/navbar.php' ?>

<?php include '../Homepage/BACK_timeout.php'?>

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

<?php

//session_start(); 

// Connect to the database
$conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$conn_postings = new mysqli('localhost', 'root', DB_PASSWORD, 'postings');
if ($conn_postings->connect_error) {
    die('Connection failed: ' . $conn_postings->connect_error);
}

// Get the current student ID
$student = $_SESSION['username'];

// Retrieve all of the job postings the student has applied to
$sql = "SELECT * FROM applications WHERE student = '$student'";
$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    // Display the results in a table
    echo "<table>";
    echo "<tr><th>Job Posting</th>";
    while ($row = mysqli_fetch_assoc($result)) {
        $job_posting_id = $row['postingid'];

        // Retrieve the job posting information from the database
        $sql = "SELECT * FROM postings WHERE id = $job_posting_id";
        $job_posting_result = mysqli_query($conn_postings, $sql);
        $job_posting_row = mysqli_fetch_assoc($job_posting_result);

        // Display the job posting information in the table
        if ($job_posting_result->num_rows > 0) {
            // Output the rows in the desired format
            echo '<div class="d-flex justify-content-between align-items-center" style="margin-top: 2%">';
            echo '<a class="btn btn-light btn-lg outer2" style="margin-left: 12.5%; width: 200px" id="search-btn">Search Filter</a>';
            echo '<h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%; margin-left: 13.5%">Search Postings</h1>';
            echo '<a href="/soen341/webpages/Search/search_page.php" class="btn btn-light btn-lg outer2" style="margin-right: 12.5%; width: 200px">Reset Filter</a>';
            echo '</div>';                
            echo '<div style="background-color: white; height: 70%; margin: auto; width: 80%; overflow: scroll; text-align: center">';
            echo '<div class="table" style="margin: auto;">';
            echo '<div class="row header-row" style="position: sticky; top: 0; background-color: #333; z-index: 1; width: auto; margin: auto;">';
            echo '<div class="cell" style="width: 100px"><h3 class="text-white postings-size" style="font-size: 1.5em">Id</h3></div>';
            echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Position</h3></div>';
            echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Company</h3></div>';
            echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Industry</h3></div>';
            if ($sql === "SELECT * FROM postings ORDER BY plocation DESC") {
                $location_label = "Location ▼";
            } else if ($sql === "SELECT * FROM postings ORDER BY plocation ASC") {
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
            echo '</div>';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">';
                echo '<a href="position.php?id=' . $row['id'] . '" style="display: contents">';
                echo '<div class="cell" style="width: 100px"><h3 class=" postings-size">' . $row['id'] . '</h3></div>';
                echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['position'] . '</h3></div>';
                echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['company'] . '</h3></div>';
                echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['industry'] . '</h3></div>';
                echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['plocation'] . '</h3></div>';
                echo '<div class="cell" style="width: 200px"><h3 class=" postings-size">' . $row['salary'] . '</h3></div>';
                echo '</a>';
                echo '</div>';                    
            }
            echo '</div>';
            echo '</div>';
        } else {
            echo "No rows found";
        }

    }
    echo "</table>";
} else {
    echo "No job postings found.";
}

// Close the database connection
mysqli_close($conn);
mysqli_close($conn_postings);
?>
</body>
</html>
