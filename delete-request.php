<?php 
require_once "database.php";

if (isset($_GET['transaction_id'])) {
    $transaction_id = $conn->real_escape_string($_GET['transaction_id']);

    $sql = "DELETE FROM `request_documents` WHERE `transaction_id` = '$transaction_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

header("Location: admin-requestdocs.php"); // Redirect back to the records page
exit;
?>