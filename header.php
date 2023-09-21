

<?php
//session_start(); // Start the session

include("db.php"); 

// Check if the user wants to log out
if (isset($_GET["logout"])) {
    // Clear the session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
			<div class="nav-logo">
                <a href="#"><img src="css/logo-main.png" alt="Logo"></a>
            </div>
            <ul class="nav-list">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="contact_us.php" class="nav-link">Contact</a></li>
				<?php
				// Check if the user is logged in and update the "My Account" button accordingly
				if (isset($_SESSION["username"])) { ?>
                <li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">My Account</a>
					<ul class="dropdown-menu">
						<li><a href="profile.php" class="dropdown-item">Profile</a></li>
						<li><a href="account.php" class="dropdown-item">Upload Documents</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php
				// Check if the user is logged in and update the "Login" button accordingly
				if (isset($_SESSION["username"])) { ?>
                <li><a href="logout.php" class="nav-link">LogOut</a></li>
				<?php } 
				else { ?>
				<li><a href="login.php" class="nav-link">LogIn</a></li>
				<?php } ?>
            </ul>
        </nav>
        
    </header>
	<body>
    <main class="main">
</body>
</html>
