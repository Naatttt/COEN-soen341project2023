<?php include 'timeout.php' ?>

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

    <body class="main-bg">
        <!-- Navigation Bar (top)-->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">

            <a class="navbar-brand summon-font brand-name" href="/soen341/index.php" style="padding-left: 16px;">
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
                        <a class="nav-link navbar-text" href="#about">
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

        <!-- Start of Page Here-->
        <div style="text-align: center; margin-top: 10%; margin-bottom: 5%;">
            <h1 class="text-white" style="font-size: 4.5vw; transition: opacity 0.5s ease-out;" id="headline">
                TalentHub
            </h1>
            <h3 class="text-white" style="margin-top: 1%; font-size: 1.4vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                Get that dream job, or make your next big step
            </h3>
        </div>

        <script>
            const headlines = ["Find Opportunities", "Put Yourself Out There", "Hire Qualified Personnel"];
            let index = 0;

            function changeHeadline() {
                const headlineElement = document.getElementById("headline");
                headlineElement.style.opacity = 0;
                setTimeout(function() {
                    headlineElement.innerHTML = headlines[index];
                    headlineElement.style.opacity = 1;
                    index = (index + 1) % headlines.length;
                }, 700); // wait for fade out transition to complete before changing text and fading in
            }

            setInterval(changeHeadline, 5000);
        </script>

        <div class="profile_buttons">
            <a href="/soen341/search_page.php" class="btn btn-primary btn-lg" style="margin-right: 10%; width: 25%"><h1>Search</h1></a>
            <a href="/soen341/update_profile.php" class="btn btn-light btn-lg" style="margin-left: 10%; width: 25%"><h1>Post Position</h1></a>
        </div>

            <!--
            Alternating Carousel
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
            </div> -->

            <div class="text-about" id="about">
                <h3 id="text1" style="font-size: 1.8em; margin-bottom: 4%; padding-top: 4%">
                    Welcome to TalentHub, the premier destination for job seekers and employers alike. Our mission is to connect talented professionals with the best job opportunities and help employers find the most qualified candidates for their open positions.
                </h3>
                <h3 id="text2" style="font-size: 1.8em; margin-bottom: 4%">
                    We believe that finding the right job or candidate can be a daunting task, but it doesn't have to be. With TalentHub, job seekers can easily browse and apply for job openings across a wide range of industries and locations. We offer a variety of tools and resources to help job seekers create winning resumes, prepare for interviews, and land their dream job.
                </h3>
                <h3 id="text3" style="font-size: 1.8em; margin-bottom: 4%">
                    For employers, TalentHub provides a streamlined hiring process that saves time and resources. Our platform allows employers to post job openings, search and filter through resumes, and connect with the most promising candidates. We understand that hiring the right person can make all the difference for a business, and we're here to help employers find the talent they need to succeed.
                </h3>
                <h3 id="text4" style="font-size: 1.8em;">
                    At TalentHub, we're passionate about helping job seekers and employers achieve their goals. Whether you're looking for a new job or searching for your next hire, we're here to support you every step of the way. Join our community today and discover the many opportunities that await you.
                </h3>
            </div>
    </body>
</html>