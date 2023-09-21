<?php
include("db.php"); // Include the database connection file
// Retrieve the session username
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} 


// Fetch the user_id based on the session username
$fetchUserIdSql = "SELECT userid FROM user_details WHERE username = ?";
$stmt = $conn->prepare($fetchUserIdSql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // User exists, fetch user_id
    $userData = $result->fetch_assoc();
    $userid = $userData["userid"];
}

// Check if the user has submitted the form for image and document upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Handle image upload
    $imageUploadDir = "uploads/images/";
    $imageFileName = $_FILES["image"]["name"];
    $imageFilePath = $imageUploadDir . $imageFileName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $imageFilePath);

    // Handle document upload
    $documentUploadDir = "uploads/documents/";
    $documentFileName = $_FILES["document"]["name"];
    $documentFilePath = $documentUploadDir . $documentFileName;
    move_uploaded_file($_FILES["document"]["tmp_name"], $documentFilePath);

    // Update the database with uploaded file names and user_id
    $updateSql = "UPDATE account_user SET photo_link = ?, document_link = ?, userid = ? WHERE userid = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssii", $imageFilePath, $documentFilePath, $userid, $userid);
    $stmt->execute();
    $stmt->close();
}

// Retrieve user data from the database
$selectSql = "SELECT * FROM account_user WHERE userid = ?";
$stmt = $conn->prepare($selectSql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>
    
    <main class="main">
        <section class="user-profile">
            <h2>Welcome, <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></h2>
            <form action="account.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="document">Upload Document:</label>
                    <input type="file" name="document" id="document">
                </div>
                <button type="submit" name="submit" class="btn-upload">Upload</button>
            </form>
            <!-- Display user data if available -->
            
     			<h3>Your Profile Information:</h3>
				<p>Name: <?php echo !empty($userData["name"]) ? $userData["name"] : "N/A"; ?></p>
				<p>UserID: <?php echo !empty($userData["userid"]) ? $userData["userid"] : "N/A"; ?></p>
				<p>Date of Birth: <?php echo !empty($userData["dob"]) ? $userData["dob"] : "N/A"; ?></p>
				<p>Phone Number: <?php echo !empty($userData["phone"]) ? $userData["phone"] : "N/A"; ?></p>
				<p>Image Link: <?php echo !empty($userData["photo_link"]) ? $userData["photo_link"] : "N/A"; ?></p>
				<p>Document Link: <?php echo !empty($userData["document_link"]) ? $userData["document_link"] : "N/A"; ?></p>


           
        </section>
    </main>
</body>
</html>
