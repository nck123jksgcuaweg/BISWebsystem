<?php
require_once "database.php";

if (isset($_GET['id'])) {
    $officialId = $_GET['id'];
    $sql = "DELETE FROM barangay_officials WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $officialId);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
        header("Location: admin-officials.php"); // Redirect after delete
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No Official ID provided for deletion.";
}
?>