<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_announcement'])) {
    if (isset($_POST['announcement_id'])) {
        $announcementId = $_POST['announcement_id'];
        $sql = "DELETE FROM announcements WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $announcementId);

        if ($stmt->execute()) {
            header("location: admin-announcement.php");
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "No Announcement ID provided for deletion.";
    }
}
?>