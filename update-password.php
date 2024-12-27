<?php
// Include the database connection
require_once "database.php";

// Start session to handle logged in user (if not already started)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $users_id = $_POST['users_id'];
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $confirmPass = $_POST['confirmPass'];

    // Validate new password and confirm password match
    if ($newPass !== $confirmPass) {
        echo "New passwords do not match.";
        exit;
    }

    // Fetch the current password from the database
    $sql = "SELECT password FROM users WHERE users_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $users_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $currentPasswordHash = $row['password'];

        // Verify the old password
        if (password_verify($oldPass, $currentPasswordHash)) {
            // Hash the new password
            $newPasswordHash = password_hash($newPass, PASSWORD_DEFAULT);

            // Update the password in the database
            $sql = "UPDATE users SET password = ? WHERE users_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newPasswordHash, $users_id);
            if ($stmt->execute()) {
                echo "Password updated successfully.";
                header("Location: change-password.php");
            } else {
                echo "Error updating password: " . $conn->error;
                header("Location: change-password.php");
            }
        } else {
            echo "Current password is incorrect.";
            header("Location: change-password.php");
        }
    } else {
        echo "User not found.";
        header("Location: change-password.php");
    }
}
$conn->close();
?>
