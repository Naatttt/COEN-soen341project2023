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
         <ul class="navbar-nav ms-auto" style="margin-right: 20px; font-size: 1vw;">
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
                <a class="nav-link dropdown-toggle navbar-text" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                <a class="nav-link navbar-text" href="/soen341/BACK_log_out.php">
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