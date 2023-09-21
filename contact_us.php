<?php
session_start(); 
include('header.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact_us.css"> 
</head>
<body>
    <main class="contact-container">
        <h1>Contact Us</h1>
        
        <div class="image-grid-contact">
				<div class="image">
					<img src="css/call.png" alt="Image 1">
					<div class="tooltip">Dial 999-999-9999 for any queries</div>
				</div>
				<div class="image">
					<img src="css/email.png" alt="Image 2">
					<div class="tooltip">Mail us your queries at support@neccorp.org</div>
				</div>
				<div class="image">
					<img src="css/fax.png" alt="Image 3">
					<div class="tooltip">Fax your queries on 555-555-5555</div>
				</div>
				
			</div>
		
    </main>
</body>
</html>

<?php include('footer.php'); // Include the footer ?>
