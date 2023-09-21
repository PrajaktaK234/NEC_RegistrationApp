<?php session_start(); // Start the session?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NEC Corporation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('header.php'); ?>

        
			<div class="background-image">
				<div class="content">
					<h1>Welcome to NEC Corporation</h1>
					<p>Discover the future of technology and innovation.</p>
				</div>
			</div>

			<div class="image-grid">
				<div class="image">
					<img src="css/newlogo.png" alt="Image 1">
					<div class="tooltip">Learn about the latest development in Machine Learning</div>
				</div>
				<div class="image">
					<img src="css/prompteng.png" alt="Image 2">
					<div class="tooltip">Learn about the latest development in Prompt Engineering</div>
				</div>
				<div class="image">
					<img src="css/artificial-intelligence.png" alt="Image 3">
					<div class="tooltip">Learn about the latest development in Artifical Intelligence</div>
				</div>
				
			</div>


<?php include('footer.php'); ?>
</body>
</html>



