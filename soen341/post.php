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

    <div class="sign-up">
        <div style="text-align: center; padding-top: 3%;">
            <h1 class="text-white" style="font-size: 4vw;">
                Create Position Posting
            </h1>
            <h3 class="text-white" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;">
            Please enter important details below
            </h3>
        </div>

        <div class="container" style="padding-top: 1%">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 class="text-white sign-up-text" style="padding-top: 2%;">Posting</h1>

                    <form class="form-signupq" action="update_posting.php" method="post" style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 50px">
                        <div class="form-group">
                            <label for="position_title">Position Title</label>
                            <input type="text" class="form-control" id="position_title" name="position_title" placeholder="Position Title">
                        </div>
                
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" id="company" name="company" aria-describedby="company" placeholder="Company Name">
                        </div>

                        <div class="form-group">
                            <label for="info">Info</label>
                            <input type="text" style="height: 200px" class="form-control" id="info" name="info" aria-describedby="info" placeholder="Positon Description">
                        </div>
                
                        <div class="form-group">
                            <label for="industry">Industry</label>
                            <input type="text" class="form-control" id="industry" name="industry" placeholder="Industry">
                        </div>
                
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                        </div>

                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary">
                        </div>
                        <button type="submit" name="create_posting" class="btn btn-primary btn-submit outer">Create Posting</button>
                    </form>                                                
                </div>
            </div>
        </div>
    </div>
</body>
</html>