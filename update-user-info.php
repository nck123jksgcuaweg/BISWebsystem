<?php
require_once "database.php";

// Check if form is submitted by admin
if (isset($_POST['submit'])) {
    // Get form data
    $users_id = $_POST['users_id'];    
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

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

    
    // Check file size
    if ($_FILES["photo"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    

    $photoPath = $targetFile; // Use the path where the file is stored

    // Insert the file path into the database along with other form data
    $stmt = $conn->prepare("UPDATE `users` SET `lastName`= ?,`firstName`= ?,`age`= ?,`sex`= ?,`address`= ?,`contact`= ?,`users_profile`= ? WHERE users_id = ?");
    $stmt->bind_param("ssissssi", $lname, $fname, $age, $sex, $address,$contact, $photoPath, $users_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: edituser.php");
    } else {
        echo "Error: " . $stmt->error;
    }
} 

elseif (isset($_POST['submit2'])) {
    // Get form data
    $users_id = $_POST['users_id'];    
    $oldUsername = $_POST['oldUser'];
    $newUsername = $_POST['newUser'];
    $confirmUsername = $_POST['confirmUser'];

    // Fetch the officials from the database
    $sql = "SELECT * FROM users where username = 'username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

    $oldUsername1 = $row["username"];
    
    if (strlen($newUsername) < 8) {
        array_push($errors, "Password must be at least 8 charactes long");
    }
    if ($newUsername !== $confirmUsername) {
        array_push($errors, "Username does not match");
    }
    if ($oldUsername !== $oldUsername1) {
        array_push($errors, "Username does not match");
    }
    else {
        array_push($errors, "You have changed your password!");
    }
}
       
    // Insert the file path into the database along with other form data
    $stmt = $conn->prepare("UPDATE `users` SET `username`= ? WHERE users_id = ?");
    $stmt->bind_param("si", $newUsername, $users_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: change-username.php");
    } else {
        echo "Error: " . $stmt->error;
    }
} 
 
?>