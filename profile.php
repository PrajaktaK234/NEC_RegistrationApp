<?php
session_start();
include("db.php");


$loggedIn = true; // Set to true if the user is logged in

    // Fetch user data from the database based on the user's session or user ID
    $userid = $_SESSION["userid"];
	$username = $_SESSION["username"];
	//print($userid);exit;
    $sql = "SELECT username, name, dob, email, photo_link, document_link, userid FROM user_details WHERE userid = ? and username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userid, $username);
    $stmt->execute();
    $result = $stmt->get_result();
//print_r($result);exit;
    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc();
    }

// Fetch the path to the user's photos based on the photo_link field
    $photoPath = $userData['photo_link'];
	//print($photoPath);exit;
    $docPath = $userData['document_link'];
    // Check if the photo and doc exists
    $photoExists = file_exists($photoPath);
	$docExists = file_exists($docPath);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/profile.css"> 
</head>
<body>
    <?php include('header.php'); ?> 
    <div class="profile-container">
        <h1> <?php echo $userData['name'].'\'s'; ?> Profile</h1>
        <?php if ($loggedIn && isset($userData)): ?>
			<form action="update_profile.php" method="POST">
                <div class="form-container">
                    <div class="profile-photo">
                        <?php if ($photoExists): ?>
							<img src="<?php echo $photoPath; ?>" alt="User Photo">
						<?php else: ?>
							<p>No profile photo uploaded.</p>
						<?php endif; ?>
                    </div>
					<div class="documents-section">
						<h2>Uploaded Documents:</h2>
						<?php if ($docExists): ?>
							<a href="<?php echo $docPath; ?>" target="_blank" style="font-size: 12px;"><?php echo $docPath;?></a><br>
						<?php else: ?>
							<p>No document uploaded.</p>
						<?php endif; ?>
					</div>
                    <div class="user-details">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $userData['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $userData['dob']; ?>">
                        </div>
                        <button type="submit" class="btn-save">Save</button>
                    </div>
					
                </div>
            </form>
		<!--
            <div class="user-details">
                <h2>Display Name: <?php echo $userData['name']; ?></h2>
                <h2>Email: <?php echo $userData['email']; ?></h2>
                <h2>Date of Birth: <?php echo $userData['dob']; ?></h2>
            </div>
            <div class="photos-section">
                <h2>Profile Photo:</h2>
                <?php if ($photoExists): ?>
                    <img src="<?php echo $photoPath; ?>" alt="User Photo">
                <?php else: ?>
                    <p>No profile photo uploaded.</p>
                <?php endif; ?>
            </div>
            <div class="documents-section">
                <h2>Uploaded Documents:</h2>
                <?php if ($docExists): ?>
                    <a href="<?php echo $docPath; ?>" target="_blank"><?php echo $docPath; ?></a><br>
                <?php else: ?>
                    <p>No document uploaded.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Please log in to view your profile.</p>
        <?php endif; ?> -->
    </div>
    <?php include('footer.php'); ?> 
</body>
</html>
