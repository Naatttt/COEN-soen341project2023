<?php

// Start the session to store any error messages
session_start();

// Check if the form has been submitted
if (isset($_POST['newname']) ||
    isset($_POST['newusername']) || 
    isset($_POST['newpassword1']) || 
    isset($_POST['newpassword2']) || 
    isset($_POST['education']) || 
    isset($_POST['experience']) ||
    isset($_POST['skills']) ||
    isset($_POST['availability']) ||
    isset($_POST['languages'])) {

    // Get the form data
    $newname = $_POST['newname'];
    $newusername = $_POST['newusername'];
    $newpassword1 = $_POST['newpassword1'];
    $newpassword2 = $_POST['newpassword2'];
    $education = $_POST['education'];
    $mylocation = $_POST['mylocation'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $availability = $_POST['availability'];
    $languages = $_POST['languages'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'users');

    // Check if the username already exists
    if (!empty($newusername)) {
        $query = "SELECT * FROM users WHERE username='$newusername'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Username already taken.";
            header("Location: error.php");
            exit;
        }
    }

    // Hash the password if it has been updated
    if (!empty($newpassword1) && ($newpassword1 === $newpassword2)) {
        $hashed_password = password_hash($newpassword1, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password='$hashed_password' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    } elseif (!empty($newpassword1) && ($newpassword1 !== $newpassword2)) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: error.php");
        exit;
    }

    // Update the name if it has been updated
    if (!empty($newname)) {
        $update_query = "UPDATE users SET name='$newname' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Update the username if it has been updated
    if (!empty($newusername)) {
        $update_query = "UPDATE users SET username='$newusername' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
        $_SESSION['username'] = $newusername;
    }

    // Update the education if it has been updated
    if (!empty($education)) {
        $update_query = "UPDATE users SET education='$education' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Update the location if it has been updated
    if (!empty($mylocation)) {
        $update_query = "UPDATE users SET mylocation='$mylocation' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Update the experience if it has been updated
    if (!empty($experience)) {
        $update_query = "UPDATE users SET experience='$experience' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Update the skills if it has been updated
    if (!empty($skills)) {
        $update_query = "UPDATE users SET skills='$skills' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }
    
    // Update the availability if it has been updated
    if (!empty($availability)) {
        $update_query = "UPDATE users SET availability='$availability' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Update the languages if it has been updated
    if (!empty($languages)) {
        $update_query = "UPDATE users SET languages='$languages' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect to the success page
    $_SESSION['success'] = "Profile updated successfully.";
    header("Location: update_profile.php");
    exit;
}
?>
