<?php session_start();  ?>
<?php include('header.php'); ?>
<?php
include("db.php"); 

if (isset($_SESSION["username"])) {
    header("Location: account.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute the SQL SELECT statement to retrieve the hashed password
    $sql = "SELECT username, password FROM user_details WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username exists, fetch the hashed password
        $stmt->bind_result($db_username, $db_hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $db_hashed_password)) {
            // Password is correct, set the username in the session
            $_SESSION["username"] = $username;

            // Redirect to the account page
            header("Location: account.php");
            exit();
        } else {
            // Invalid password, display an alert and redirect to login page
            echo "<script>alert('Invalid password. Please try again.');</script>";
            echo "<script>window.location = 'login.php';</script>";
            exit();
        }
    } else {
        // Username not found, display an alert and redirect to login page
        echo "<script>alert('Username not found. Please try again.');</script>";
        echo "<script>window.location = 'login.php';</script>";
        exit();
    }

    $stmt->close();
}

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
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

	<main class="main">
        <section class="form-container-login">
           <h2 class="form-title">Login</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
			<br/>
			<a href="register.php">New User? Register Here</a>
			
        </section>
    </main>
</body>
</html>


<?php include('footer.php'); ?>
