<?php include 'BACK_timeout.php' ?>

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
        <?php include 'navbar.php' ?>
        
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

            if (!isset($_GET["query"])) {
                $query = "SELECT * FROM postings";
            } else if (isset($_GET["query"])) {
                $query = urldecode($_GET["query"]);
            }

            $result = $conn->query($query);

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Output the rows in the desired format
                echo '<div class="d-flex justify-content-between align-items-center" style="margin-top: 2%">';
                echo '<a href="/soen341/search_page.php" class="btn btn-light btn-lg outer2" style="margin-left: 10%; width: 200px">Reset Page</a>';
                echo '<h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%; margin-left: 16%">Search Postings</h1>';
                echo '</div>';                
                echo '<div style="background-color: white; height: 70%; margin: auto; width: 80%; overflow: scroll; text-align: center">';
                echo '<div class="table" style="margin: auto;">';
                echo '<div class="row header-row" style="position: sticky; top: 0; background-color: #333; z-index: 1; width: auto; margin: auto;">';
                echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Position</h3></div>';
                echo '<div class="cell" style="width: 300px"><h3 class="text-white postings-size" style="font-size: 1.5em">Company</h3></div>';
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
                echo '<div class="cell" style="width: 300px"><button style="border: none" onclick="refreshPage()"><h3 class="text-white postings-size" style="font-size: 1.5em" id="salary-btn" onclick="changeSalary()">' . $salary_label . '</h3></button></div>';                
                echo '</div>';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">';
                    echo '<a href="position.php?id=' . $row['id'] . '" style="display: contents">';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['position'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['company'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['industry'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['plocation'] . '</h3></div>';
                    echo '<div class="cell" style="width: 300px"><h3 class=" postings-size">' . $row['salary'] . '</h3></div>';
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

    <script>
        // get the button elements
        const salaryBtn = document.querySelector('#salary-btn');
        const locationBtn = document.querySelector('#location-btn');

        // add click event listeners to the buttons
        salaryBtn.addEventListener('click', function() {
            // get the current query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const query = urlParams.get('query');

            // determine the current sort order for salary
            let sortOrder = 'ASC';
            if (query && query.includes('DESC')) {
                sortOrder = 'ORDER BY salary ASC';
            } else {
                sortOrder = 'ORDER BY salary DESC';
            }

            // construct the new query string
            let newQuery = 'SELECT * FROM postings ' + sortOrder;

            // update the query parameter in the URL and reload the page
            urlParams.set('query', newQuery);
            window.location.search = urlParams.toString();
        });

        locationBtn.addEventListener('click', function() {
            // get the current query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const query = urlParams.get('query');

            // determine the current sort order for location
            let sortOrder = 'ASC';
            if (query && query.includes('ASC')) {
                sortOrder = 'ORDER BY plocation DESC';
            }
            else {
                sortOrder = 'ORDER BY plocation ASC';
            }


            // construct the new query string
            let newQuery = 'SELECT * FROM postings ' + sortOrder;

            // update the query parameter in the URL and reload the page
            urlParams.set('query', newQuery);
            window.location.search = urlParams.toString();
        });
    </script>

    </body>
</html>