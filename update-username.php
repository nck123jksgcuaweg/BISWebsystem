<?php
// Include the database connection
require_once "database.php";

// Start session to handle logged in user (if not already started)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $user_id = $_POST['users_id'];
    $oldUser = $_POST['oldUser'];
    $newUser = $_POST['newUser'];
    $confirmUser = $_POST['confirmUser'];

    // Validate input
    if (empty($oldUser) || empty($newUser) || empty($confirmUser)) {
        echo "All fields are required.";
        exit;
    }

    // Fetch current user data
    $sql = "SELECT * FROM `users` WHERE `users_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit;
    }

    // Verify old username and password
    if ($user['username'] !== $oldUser || !password_verify($confirmUser, $user['password'])) {
        echo "Old username or password is incorrect.";
        exit;
    }

    // Update username
    $sql = "UPDATE `users` SET `username` = ? WHERE `users_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newUser, $user_id);

    if ($stmt->execute()) {
        echo "Username updated successfully.";
        // Optionally redirect or inform user
        header("Location: profile.php");
        exit;
    } else {
        echo "Error updating username: " . $conn->error;
    }
}
$conn->close();
?>
