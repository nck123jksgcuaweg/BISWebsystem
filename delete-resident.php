<?php
require_once "database.php";

if (isset($_GET['residentId'])) {
    $residentId = $_GET['residentId'];
    $sql = "DELETE FROM residentsrecords WHERE residentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $residentId);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
        header("Location: admin-residentsrecords.php"); // Redirect after delete
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No Resident ID provided for deletion.";
}
?>