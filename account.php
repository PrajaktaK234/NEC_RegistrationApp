<?php
session_start(); 

include("db.php"); 

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION["username"];

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

    $_SESSION["userid"] = $userid;
}

$userid = $_SESSION["userid"]; 


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload-photo"])) {
    $imageUploadDir = "uploads/images/user_" . $userid . "/";
    if (!file_exists($imageUploadDir)) {
        mkdir($imageUploadDir, 0777, true); // Create the directory if it doesn't exist
    }

    $imageFileName = $_FILES["profile-photo"]["name"];
    $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));
    $imageFilePath = $imageUploadDir . "profile_photo." . $imageFileType;

    // Validate image size and type
    $validImageTypes = ["jpg", "jpeg", "png", "gif"];
    if ($_FILES["profile-photo"]["size"] > 5242880 || !in_array($imageFileType, $validImageTypes)) {
        $photoErrorMessage = "Invalid image. Please upload a valid image (max 5MB, JPG, JPEG, PNG, GIF).";
    } else {
        move_uploaded_file($_FILES["profile-photo"]["tmp_name"], $imageFilePath);
        $photoSuccessMessage = "Profile photo uploaded successfully.";
		
		$updatePhotoSql = "UPDATE user_details SET photo_link = ?, updated_date = NOW() WHERE userid = ? AND username = ?";
		$stmt = $conn->prepare($updatePhotoSql);
		$stmt->bind_param("sis", $imageFilePath, $userid, $username);
		$stmt->execute();
		$stmt->close();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload-document"])) {
    $documentUploadDir = "uploads/documents/user_" . $userid . "/";
    if (!file_exists($documentUploadDir)) {
        mkdir($documentUploadDir, 0777, true); 
    }

    $documentFileName = $_FILES["user-document"]["name"];
    $documentFileType = strtolower(pathinfo($documentFileName, PATHINFO_EXTENSION));
    $documentFilePath = $documentUploadDir . "user_document." . $documentFileType;

    // Validate document size and type
    $validDocumentTypes = ["pdf", "doc", "docx"];
    if ($_FILES["user-document"]["size"] > 10485760 || !in_array($documentFileType, $validDocumentTypes)) {
        $documentErrorMessage = "Invalid document. Please upload a valid document (max 10MB, PDF, DOC, DOCX).";
    } else {
        move_uploaded_file($_FILES["user-document"]["tmp_name"], $documentFilePath);
        $documentSuccessMessage = "Document uploaded successfully.";

        // Update the database with the new document link
        $updateDocumentSql = "UPDATE user_details SET document_link = ?, updated_date = NOW() WHERE userid = ? AND username = ?";
        $stmt = $conn->prepare($updateDocumentSql);
        $stmt->bind_param("sis", $documentFilePath, $userid, $username);
        $stmt->execute();
        $stmt->close();
    }
}


// Fetch user data from the database
$selectSql = "SELECT * FROM user_details WHERE userid = ?";
$stmt = $conn->prepare($selectSql);
$stmt->bind_param("i", $user_id);
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
    <title>My Account</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main class="main">
        <section class="user-profile-acc">
            <h2>Welcome, <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "Guest"; ?></h2>

            <?php
            if (isset($photoSuccessMessage)) {
                echo '<p class="success-message">' . $photoSuccessMessage . '</p>';
            } elseif (isset($photoErrorMessage)) {
                echo '<p class="error-message">' . $photoErrorMessage . '</p>';
            }
            
            if (isset($documentSuccessMessage)) {
                echo '<p class="success-message">' . $documentSuccessMessage . '</p>';
            } elseif (isset($documentErrorMessage)) {
                echo '<p class="error-message">' . $documentErrorMessage . '</p>';
            }
            ?>

            <!-- Upload profile photo -->
            <form action="account.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profile-photo">Upload Profile Photo:</label>
                    <input type="file" name="profile-photo" id="profile-photo" accept="image/*">
                </div>
                <button type="submit" name="upload-photo" class="btn-upload">Upload Photo</button>
            </form>

            <!-- Display profile photo if uploaded -->
            <?php if (isset($userData["photo_link"])): ?>
                <div class="profile-photo">
                    <img src="<?php echo $userData["photo_link"]; ?>" alt="Profile Photo">
                </div>
            <?php endif; ?>

            <!-- Upload user document -->
            <form action="account.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="user-document">Upload User Document:</label>
                    <input type="file" name="user-document" id="user-document" accept=".pdf, .doc, .docx">
                </div>
                <button type="submit" name="upload-document" class="btn-upload">Upload Document</button>
            </form>

            <!-- Display user document if uploaded -->
            <?php if (isset($userData["document_link"])): ?>
                <div class="document">
                    <a href="<?php echo $userData["document_link"]; ?>" target="_blank">View Document</a>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>
