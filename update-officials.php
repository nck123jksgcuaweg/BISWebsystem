<?php
require_once "database.php";

if (isset($_POST['submit'])) {
    $officialId = $_POST['officialId'];
    $fullName = $_POST['fullname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $position = $_POST['position'];
    $address = $_POST['address'];
    $startterm = $_POST['startterm'];
    $endterm = $_POST['endterm'];

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Directory where uploaded files will be saved
    $uploadDir = "uploads/";

    // Check if the directory exists, if not, create it
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Recursive directory creation
    }

    if ($_FILES["photo"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $photoPath = $targetFile; // Use the path where the file is stored

    $sql = "UPDATE barangay_officials SET 
            full_name=?, position=?, age=?, address=?, sex=?, term_start=?, term_end=?, profile_image=?
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $fullName, $position, $age, $address, $sex, $startterm, $endterm, $photoPath, $officialId);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header("Location: admin-officials.php"); // Redirect to a current page
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: admin-officials.php");
}
?>