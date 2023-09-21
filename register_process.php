<?php session_start(); ?>
<?php
include("db.php"); 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	$name = $_POST["name"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"]; 
	$formattedDob = date('Y-m-d', strtotime($dob));

    // Check if the username already exists
    $check_username_sql = "SELECT id FROM user_details WHERE username = ?";
    $stmt_check = $conn->prepare($check_username_sql);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();
	
    if ($stmt_check->num_rows > 0) {
        // Username already exists, display an alert and redirect to registration page
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
        echo "<script>window.location = 'register.php';</script>";
    } else {
        // Prepare and execute the SQL INSERT statement
        $insert_sql = "INSERT INTO user_details (username, email, password, userid, name, dob, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
		$userid = 'NECREG_'.$username;

        $stmt->bind_param("sssssss", $username, $email, $hashedPassword, $userid, $name, $formattedDob, $phone);

        if ($stmt->execute()) {
            // Registration successful, redirect to login page
			echo "<script>alert('Registration Successful. Please Login to the portal with your credentials');</script>";
            echo "<script>window.location = 'login.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
