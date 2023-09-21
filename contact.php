<?php
session_start(); // Start the session
include('header.php'); // Include the header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact_us.css"> <!-- Include your CSS file here -->
</head>
<body>
    <main class="contact-container">
        <h1>Contact Us</h1>
        <div class="background-image"></div> <!-- Background image for the body -->
        <div class="images-section">
            <div class="image">
                <img src="image1.jpg" alt="Image 1">
                <p>Image 1 Description</p>
            </div>
            <div class="image">
                <img src="image2.jpg" alt="Image 2">
                <p>Image 2 Description</p>
            </div>
            <div class="image">
                <img src="image3.jpg" alt="Image 3">
                <p>Image 3 Description</p>
            </div>
        </div>
    </main>
</body>
</html>

<?php include('footer.php'); // Include the footer ?>
