<?php
session_start(); // Start the session

// Unset all session values
session_unset();

// Destroy the session
session_destroy();

// Redirect to the index page (landing page)
header("Location: index.php");
exit(); // Terminate script execution after redirection
?>
