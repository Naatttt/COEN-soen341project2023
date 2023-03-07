<?php include 'timeout.php' ?>
<?php include 'store_pdf.php' ?>

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
                                <a class="dropdown-item navbar-text" href="/soen341/post.php" style="color: #212529">
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
            <h1 class="text-white" style="font-size: 3vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                Current Profile
            </h1>
        </div>

        <div class="table" style="margin: auto; margin-top: 1%; text-align: center">
            <div class="row" style="width: 800px; margin: auto; text-align: center">
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Name</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Username</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Education</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Location</h3></div>
            </div>
            <div class="row" style="width: 800px; margin: auto; text-align: center">
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $name ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $username ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $education ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $mylocation ?></p></div>
            </div>

            <button type="button" style="margin-top: 1%" class="btn btn-primary" id="edit-profile-button">Edit Profile</button>
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

            <div style="background-color: #E5F2F7; padding: 40px; width: 60%; margin: auto; border-radius: 10px">
                <h1 style="color: #333333; font-size: 3vw; font-family: 'Lato', sans-serif; font-weight: 400; margin-top: 0;">Update Resume</h1>
                <form method="post" enctype="multipart/form-data" style="margin-top: 20px;">
                    <label for="pdf-upload" style="color: #333333; font-size: 1.6vw; font-family: 'Lato', sans-serif; font-weight: 300; display: block;">Choose a PDF file to upload:</label>
                    <div style="position: relative; display: inline-block; margin-top: 10px;">
                        <input type="file" id="pdf-upload" name="pdf" style="position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer;" />
                        <div style="background-color: #0099ff; color: #FFFFFF; font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400; border: none; padding: 10px 20px; border-radius: 5px; display: inline-block; cursor: pointer;">Choose File</div>
                    </div>
                    <button type="submit" name="submit" style="background-color: #0099ff; color: #FFFFFF; font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400; border: none; padding: 10px 20px; border-radius: 5px; margin-top: 20px; cursor: pointer;">Upload</button>
                </form>
            </div>



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
    </body>
</html>