<?php
require_once "database.php";

if (isset($_POST['submit_announcement'])) {
    $announcementId = $_POST['announcementId'];
    $what = $_POST['what'];
    $who = $_POST['who'];
    $when = $_POST['when'];
    $where = $_POST['where'];
    $why = $_POST['why'];

    $sql = "UPDATE announcements SET 
            whatt=?, whoo=?, whenn=?, wheree=?, whyy=?
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $what, $who, $when, $where, $why, $announcementId);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header("Location: admin-announcement.php"); // Redirect to a current page
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: admin-announcement.php");
}
?>