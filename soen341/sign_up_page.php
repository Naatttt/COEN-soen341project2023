<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // If the user is not logged in, redirect to the login page
    header("Location: dashboard.php");
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
    <?php include 'navbar.php' ?>

    <div class="sign-up">
        <div style="text-align: center; padding-top: 3%;">
            <h1 class="text-white" style="font-size: 4vw;">
                Let's Get Started
            </h1>
            <h3 class="text-white" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;">
            Please enter your details below
            </h3>
        </div>

        <div class="container" style="padding-top: 1%">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 class="text-white sign-up-text">Log In</h1>

                    <form class="form-login" action="BACK_log_in.php" method="post">
                        <div class="form-group">
                            <label for="inputEmail">Username</label>
                            <input type="username" class="form-control" id="username" name="inputusername" aria-describedby="emailHelp" placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="password" name="inputpassword" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-submit outer">Log In</button>
                    </form>

                    <h1 class="text-white sign-up-text" style="padding-top: 2%;">Sign Up</h1>

                    <form class="form-signupq" action="BACK_sign_up.php" method="post" style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 50px">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label for="password1">Password</label>
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="password2">Confirm Password</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="usertype" id="employee" value="employee" onclick="checkOne(this)">
                            <label class="form-check-label" for="employee">
                            Employee
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="usertype" id="employer" value="employer" onclick="checkOne(this)">
                            <label class="form-check-label" for="employer">
                            Employer
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit outer">Sign Up</button>
                    </form>
                             
                    <script>
                        function checkOne(checkbox) {
                        if (checkbox.name === 'employee' && checkbox.checked) {
                            document.getElementById('employer').checked = false;
                        }
                        else if (checkbox.name === 'employer' && checkbox.checked) {
                            document.getElementById('employee').checked = false;
                        }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>
</html>