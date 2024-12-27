<?php
require_once "database.php";

if (isset($_POST['submit'])) {
    $residentId = $_POST['residentId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $sname = $_POST['sname'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $sex = $_POST['sex'];
    $citizenship = $_POST['citizenship'];
    $national_ID = $_POST['national_ID'];
    $birthmonth = $_POST['birthmonth'];
    $birthday = $_POST['birthday'];
    $birthyear = $_POST['birthyear'];
    $birthplace = $_POST['birthplace'];
    $occupation = $_POST['occupation'];
    $email = $_POST['email'];
    $houseNum = $_POST['houseno'];
    $purok = $_POST['purok'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $province = $_POST['province'];

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
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
        
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            //echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }

    $photoPath = $targetFile; // Use the path where the file is stored

    $sql = "UPDATE residentsrecords SET 
            fName=?, lName=?, mName=?, sName=?, sex=?, age=?, contact=?, 
            birthmonth=?, birthday=?, birthyear=?, birthplace=?, 
            citizenship=?, national_ID=?, occupation=?, email=?, houseNum=?, 
            purok=?, barangay=?, municipality=?, province=?, photo_path=?
            WHERE residentId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssisssssssssssssssi", $fname, $lname, $mname, $sname, $sex, $age, $contact, $birthmonth, $birthday, $birthyear, $birthplace, $citizenship, $national_ID, $occupation, $email, $houseNum, $purok, $barangay, $municipality, $province, $photoPath, $residentId);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header("Location: admin-residentsrecords.php"); // Redirect to a current page
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: admin-residentsrecords.php");
}
?>