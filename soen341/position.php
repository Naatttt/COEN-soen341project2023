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
$mysqli = new mysqli("localhost", "root", "", "postings");

// Retrieve the posting data using the ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT position, company, info, industry, plocation, salary FROM postings WHERE id = '$id'";
    $result = $mysqli->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the row from the query result and get the data
        $row = $result->fetch_assoc();
        $position = $row['position'];
        $company = $row['company'];
        $info = $row['info'];
        $industry = $row['industry'];
        $plocation = $row['plocation'];
        $salary = $row['salary'];
    } else {
        // Display an error message if the query failed
        $name = "Error: " . $mysqli->error;
    }
} else {
    // If no ID is provided in the URL, redirect to the homepage
    header("Location: index.php");
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

        <div class="table" style="margin: auto; margin-top: 4%; text-align: center">
            <div class="row" style="width: 1800px; margin: auto; text-align: center">
                <div class="cell" style="width: 300px"><a href="search_page.php" class="btn btn-light btn-lg outer2" style="background-color: #ffffff; margin-left: 2%; margin-top: 2%; width: 200px">Back to Search</a></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Position</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Company</h3></div>
                <div class="cell" style="width: 500px"><h3 class="text-white" style="font-size: 1.5em">Description</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Industry</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Location</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Salary</h3></div>
            </div>
            <div class="row" style="width: 1800px; margin: auto; text-align: center">
                <div class="cell" style="width: 300px"><p class="text-white"></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $position ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $company ?></p></div>
                <div class="cell" style="width: 500px; text-align: justify; text-justify: inter-word;"><p class="text-white"><?php echo $info ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $industry ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $plocation ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $salary ?></p></div>
            </div>
        </div>

        <script>
		document.getElementById("edit-profile-button").addEventListener("click", function() {
			document.getElementById("edit-profile-form").classList.toggle("d-none");
            document.getElementById("edit-profile-button").classList.toggle("d-none");
		});
	    </script>


        <script>
        document.getElementById("save-button").addEventListener("click", function() {
            document.getElementById("edit-profile-form").classList.toggle("d-none")
        }
        </script>


        <div class="container d-none" id="edit-profile-form" style="padding-top: 1%">
            <div class="row" style="text-align: center">
                
                 <h1 class="text-white" style="font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400; margin-top: 1%">Update Resume</h1>
                        <form method="post" enctype="multipart/form-data">
                            <input type="file" name="pdf" />
                            <input type="submit" name="submit" value="Upload" />
                        </form>

                <div class="col-md-6 offset-md-3" style="margin-top: 2%">
                    <form class="form-signupq" action="update_profile_info.php" method="post" style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 50px">
                        <div class="form-group">
                            <label for="name">Update Name</label>
                            <input type="text" class="form-control" id="name" name="newname" placeholder="Name">
                        </div>
                
                        <div class="form-group">
                            <label for="username">Update Username</label>
                            <input type="text" class="form-control" id="username" name="newusername" aria-describedby="username" placeholder="Username">
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="username">Update Education</label>
                            <input type="text" class="form-control" id="education" name="education" aria-describedby="education" placeholder="Education">
                        </div>

                        <div class="form-group">
                            <label for="username">Update Location</label>
                            <input type="text" class="form-control" id="location" name="mylocation" aria-describedby="location" placeholder="Location">
                        </div>

                        <hr>
                
                        <div class="form-group">
                            <label for="password1">Update Password</label>
                            <input type="password" class="form-control" id="password1" name="newpassword1" placeholder="Password">
                        </div>
                
                        <div class="form-group">
                            <label for="password2">Confirm Password</label>
                            <input type="password" class="form-control" id="password2" name="newpassword2" placeholder="Confirm Password">
                        </div>
                        <button type="submit" id="save-button" class="btn btn-primary btn-submit">Save</button>
                    </form>
                </div>            
            </div> 
        </div> 
    </body>
</html>