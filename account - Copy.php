<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>
<?php include('header.php'); ?>
    <main class="main">
        <section class="user-profile">
            <h2>Welcome, <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></h2>
            
            <!-- Upload and display profile photo -->
            <div class="profile-photo">
                <img src="profile_photo.jpg" alt="">
                <input type="file" name="profile-photo" accept="image/*">
            </div>

            <!-- Upload and display document -->
            <div class="document">
                <a href="user_document.pdf" target="_blank">View Document</a>
                <input type="file" name="user-document" accept=".pdf">
            </div>

            <!-- Update user information -->
            <form action="update_profile.php" method="POST">
                <div class="form-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" name="first-name" id="first-name" value="[User's First Name]">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" name="last-name" id="last-name" value="[User's Last Name]">
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" value="[User's DOB]">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" name="phone" id="phone" value="[User's Phone Number]">
                </div>
                <button type="submit" class="btn-update">Update Profile</button>
            </form>
        </section>
    </main>
	<?php include('footer.php'); ?>
</body>
</html>
