<?php
session_start();

if (!isset($_SESSION['timestamp'])) {
    $_SESSION['timestamp'] = time();
}

$timeout_minutes = 10;

// Check if the session has timed out
if (time() - $_SESSION['timestamp'] > $timeout_minutes * 60) {
    // Destroy the session and log the user out
    session_destroy();
    header("Location: ../SignUp/sign_up_page.php");
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