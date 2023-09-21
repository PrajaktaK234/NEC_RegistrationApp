<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register with NEC Corp</title>
	<link rel="stylesheet" href="css/register.css">
	<style>
        body {
            /* Add your body background image and other styles here */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Add your other CSS styles here */
        .form-container {
            /* Style for the form container */
			background-image: url('css/login-bg.jpg'); /* Background image URL */
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Box shadow */
        }
    </style>
</head>
<body>
	<?php include('header.php'); ?>

    
        <section class="form-container">
            <h2 class="form-title">Register</h2>
            <form action="register_process.php" method="POST" class="register-form" onsubmit="return validateForm()">
				<div class="form-group">
                    <label for="username">Name</label>
                    <input type="text" name="name" id="name" required>
                    <p class="error" id="name-error"></p>
                </div>
				<div class="form-group">
                    <label for="username">Date of Birth</label>
                    <input type="text" name="dob" id="dob" required>
                    <p class="error" id="dob-error"></p>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                    <p class="error" id="username-error"></p>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                    <p class="error" id="email-error"></p>
                </div>
				<div class="form-group">
                    <label for="username">Phone</label>
                    <input type="text" name="phone" id="phone" maxlength="10" required>
                    <p class="error" id="phone-error"></p>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <p class="error" id="password-error"></p>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input type="password" name="password-confirm" id="password-confirm" required>
                    <p class="error" id="password-confirm-error"></p>
                </div>
                <button type="submit" class="btn-register">Register</button>
            </form>
        </section>
   
    <?php include('footer.php'); ?>

    <script src="js/validation.js"></script>
</body>
</html>



