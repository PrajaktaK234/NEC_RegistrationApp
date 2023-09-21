<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user details from session
    $userid = $_SESSION["userid"];
	$username = $_SESSION["username"];
    // Retrieve user inputs from the form
    $name = $_POST["name"];
    //$email = $_POST["email"];
    $dob = $_POST["dob"];
//print($name); print($email);exit;
    // Prepare and execute an SQL UPDATE statement to update user information
    $updateSql = "UPDATE user_details SET name = ?, dob = ? WHERE userid = ? and username = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssis", $name, $dob, $userid, $username);

    if ($stmt->execute()) {
        header("Location: profile.php"); // Redirect back to the user profile page
        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle invalid request method (not a POST request)
    echo "Invalid request method.";
}
?>
