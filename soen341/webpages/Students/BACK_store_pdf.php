<?php include '../../DB_PASSWORD.php' ?>
<?php

// Check if the user is logged in
if(!isset($_SESSION['username'])) {
  echo "Error: You must be logged in to upload a PDF file.";
  exit;
}

// Check if the form has been submitted
if(isset($_POST['submit'])) {
  // Get the uploaded file information
  $pdf_name = $_FILES['pdf']['name'];
  $pdf_type = $_FILES['pdf']['type'];
  $pdf_size = $_FILES['pdf']['size'];
  $pdf_temp = $_FILES['pdf']['tmp_name'];
  
  // Check if the file is a PDF
  if($pdf_type != 'application/pdf') {
    echo "Error: Only PDF files are allowed.";
  } else {
    // Open a database connection
    $conn = mysqli_connect("localhost", "root", DB_PASSWORD, "users");
    
    // Check if the connection is successful
    if(!$conn) {
      die("Error: Could not connect to database.");
    }
    
    // Read the PDF file contents
    $pdf_content = file_get_contents($pdf_temp);
    
    // Get the username of the logged-in user
    $username = $_SESSION['username'];
    
    // Prepare the SQL statement to update the logged-in user's row in the database
    $sql = "UPDATE users SET pdfname = ?, pdftype = ?, pdfsize = ?, pdfcontent = ? WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiss", $pdf_name, $pdf_type, $pdf_size, $pdf_content, $username);
    
    // Execute the SQL statement
    if(mysqli_stmt_execute($stmt)) {
      echo "PDF file uploaded successfully.";
    } else {
      echo "Error: Could not upload PDF file.";
    }
    
    // Close the database connection
    mysqli_close($conn);
  }
}
?>
