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

        <!-- Start of Page Here-->
        <div>

            <div style="text-align: center; margin-top: 200px; margin-bottom: auto;">
                <h3 class="text-white" style="margin-top: 30px; font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                    You have already applied to this position!
                </h3>
                <div class="cell" style="width: 300px"><a href="search_page.php" class="btn btn-light btn-lg outer2" style="background-color: #ffffff; margin-left: 100%; margin-top: 15%; width: 200px">Back to Search</a></div>

            </div>
    </body>
</html>