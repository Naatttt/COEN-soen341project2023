<?php
session_start();

if (!isset($_SESSION['timestamp'])) {
    $_SESSION['timestamp'] = time();
}

$timeout_minutes = 10;

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $h1_text = "Log In";
}
else {
    $h1_text = "Dashboard";
}

// Check if the session has timed out
if (time() - $_SESSION['timestamp'] > $timeout_minutes * 60) {
    // Destroy the session and log the user out
    session_destroy();
    header("Location: sign_up_page.php");
    exit();
}

// Update the session timestamp
$_SESSION['timestamp'] = time();
?>

<script>
    var timeout_seconds = <?php echo $timeout_minutes * 60; ?>;

    var countdown_timer = setInterval(function() {
        timeout_seconds--;
        if (timeout_seconds <= 0) {
            clearInterval(countdown_timer);
            window.location.href = "index.php";
        }
    }, 1000);

    document.addEventListener("mousemove", reset_timer);
    document.addEventListener("keypress", reset_timer);

    function reset_timer() {
        timeout_seconds = <?php echo $timeout_minutes * 60; ?>;
    }
</script>



<!DOCTYPE html>
<html lang="en" class="bg-image">
    <head>
        <meta charset="UTF-8">
        <title>Summon</title>

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

    <body class="bg-image">

        <!-- Navigation Bar (top)-->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">

            <a class="navbar-brand summon-font" href="/soen341/index.php" style="margin-left: 16px;">
                <h1 class="brand-name" style="margin: auto;">
                    Summon
                </h1>
            </a>

            <!-- Dynamic Button for mobile/small screen-->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: 20px;">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Elements in navbar-->
            <div class="collapse navbar-collapse summon-font" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto" style="margin-right: 20px; font-size: 21px; padding-left: 45%;">

                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/index.php">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="#about">
                            About
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbar-text" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Search
                        </a>

                        <!-- Dropdown menu-->
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item navbar-text" href="#" style="color: #212529">
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
                        <a class="nav-link navbar-text" href="/soen341/sign_up_page.php">
                            <?php echo $h1_text; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Start of Page Here-->
        <div>

            <div style="text-align: center; margin-top: 3%; margin-bottom: 3%;">
                <h1 class="text-white" style="font-size: 4vw;">
                    Put Yourself Out There
                </h1>
                <h3 class="text-red" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                Get that dream job, or make your next big step
                </h3>
            </div>

            <!-- Alternating Carousel-->
            <div id="carouselMain" class="carousel carousel slide" data-bs-ride="carousel" style="background-color: transparent;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner carousel-image outer">
                    <div class="carousel-item active" data-bs-interval="4000">
                        <img src="/soen341/images/carousel-3.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block" style="display: flex; text-align: center; justify-content: center; height: 30%;">
                            <h1 class="carousel-text">
                                Filter by Industry and Salary
                            </h1>
                        </div>
                    </div>
                    <div class="carousel-item"  data-bs-interval="4000">
                        <img src="/soen341/images/carousel-1.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block" style="display: flex; text-align: center; justify-content: center; height: 65%;">
                            <h1 class="carousel-text">
                                Start Making Genuine Connections 
                            </h1>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="/soen341/images/new-carousel-1.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block" style="display: flex; text-align: center; justify-content: center; height: 90%;">
                            <h1 class="carousel-text">
                                Open Your Horizons
                            </h1>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="text-white" id="about" style="width: 50%; height: 500px; margin: 30% auto 0 auto; padding-top: 50px; text-align: center;">
            <h3 style="font-size: 1.2em;">
                Summon is the all in one place to find your next opportunity.
            </h3>

        </div>

    

        <div class="bottom-container" style="height: 50px; padding-bottom: 0px; padding-top: 10px;">
            <p class="text-white" style="font-size: 1vmax;">
                Summon © 2023
            </p>

        </div>
    </body>
</html>