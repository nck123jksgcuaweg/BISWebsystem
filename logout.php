<?php
session_start();

// Check if the user is logged in as a user
if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]); // Clear user session data
    header("Location: login.php"); // Redirect to user login page
    exit;
}

// Check if the user is logged in as an admin
if (isset($_SESSION["admin"])) {
    unset($_SESSION["admin"]); // Clear admin session data
    header("Location: login-admin.php"); // Redirect to admin login page
    exit;
}

// If neither user nor admin is logged in, redirect to a default page
header("Location: default.php");
exit;
?>
