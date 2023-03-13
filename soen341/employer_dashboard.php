<?php include 'BACK_timeout.php' ?>

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
$query = "SELECT usertype, name, username, education, mylocation, experience, skills, availability, languages FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the query result and get the name value
    $row = $result->fetch_assoc();
    $usertype = $row['usertype'];
    $name = $row['name'];
    $education = $row['education'];
    $mylocation = $row['mylocation'];
    $experience = $row['experience'];
    $skills = $row['skills'];
    $availability = $row['availability'];
    $languages = $row['languages'];
} else {
    // Display an error message if the query failed
    $name = "Error: " . $mysqli->error;
}

if($usertype == 'employee') {
    header("Location: dashboard.php");
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
        <link rel="icon" href="favicon.ico">

        <!-- Linking font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    </head>

    <body class="background-image">
        <?php include 'navbar.php' ?>

        <div style="text-align: center; padding-top: 3%;">
            <h1 class="text-white" style="font-size: 4vw; transition: opacity 0.5s ease-out;" id="headline">
                [<?php echo $name; ?>] Candidates Page
            </h1>
        </div>

        <div class="profile_buttons">
            <a href="/soen341/search_page.php?query=SELECT+%2A+FROM+postings+WHERE+1%3D1+AND+company+%3D+%27<?php echo $name; ?>%27" class="btn btn-primary btn-lg outer" style="margin-right: 5%; width: 200px">List Postings</a>
            <a href="/soen341/update_profile.php" class="btn btn-light btn-lg outer2" style="margin-left: 5%; width: 200px">Update Profile</a>
        </div>

        <!-- Start of Page Here-->
        <div class="table" style="margin: auto; margin-top: 3%; text-align: center">
            <div class="row" style="width: 1000px; margin: auto; text-align: center">
                <div class="cell" style="width: 500px"><h3 class="text-white" style="font-size: 2vw">Company Name</h3></div>
                <div class="cell" style="width: 500px"><h3 class="text-white" style="font-size: 2vw">Username</h3></div>
            </div>
            <div class="row" style="width: 1000px; margin: auto; text-align: center">
                <div class="cell" style="width: 500px"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $name ?></h3></div>
                <div class="cell" style="width: 500px"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $username ?></h3></div>
            </div>

            <hr>
            
            <?php include 'BACK_display_pdf.php' ?>
        </div>
        }
    </body>
</html>