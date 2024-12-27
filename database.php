<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "userregistration";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get total number of residents
function getTotalResidents($conn) {
    $sql = "SELECT COUNT(*) AS totalResidents FROM residentsrecords";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["totalResidents"];
    } else {
        return 0;
    }
}

// Get total residents count
$totalResidents = getTotalResidents($conn);

// Update total residents count
$sqlCount = "SELECT COUNT(*) AS total FROM residentsrecords";
$resultCount = $conn->query($sqlCount);
if ($resultCount->num_rows > 0) {
    $row = $resultCount->fetch_assoc();
    $totalResidents = $row["total"];
} else {
    $totalResidents = 0;
}

// Function to get total number of residents
function getTotalAnnouncement($conn) {
    $sql = "SELECT COUNT(*) AS totalAnnouncement FROM announcements";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["totalAnnouncement"];
    } else {
        return 0;
    }
}

// Get total residents count
$totalAnnouncement = getTotalAnnouncement($conn);

// Update total residents count
$sqlCount = "SELECT COUNT(*) AS total FROM announcements";
$resultCount = $conn->query($sqlCount);
if ($resultCount->num_rows > 0) {
    $row = $resultCount->fetch_assoc();
    $totalAnnouncement = $row["total"];
} else {
    $totalAnnouncement = 0;
}

// Function to get total number of residents
function getTotalOfficials($conn) {
    $sql = "SELECT COUNT(*) AS totalOfficials FROM barangay_officials";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["totalOfficials"];
    } else {
        return 0;
    }
}

// Get total residents count
$totalOfficials = getTotalOfficials($conn);

// Update total residents count
$sqlCount = "SELECT COUNT(*) AS total FROM barangay_officials";
$resultCount = $conn->query($sqlCount);
if ($resultCount->num_rows > 0) {
    $row = $resultCount->fetch_assoc();
    $totalOfficials = $row["total"];
} else {
    $totalOfficials = 0;
}

// Function to get total number of request
function getTotalRequest($conn) {
    $sql = "SELECT COUNT(*) AS totalRequest FROM request_documents";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["totalRequest"];
    } else {
        return 0;
    }
}

// Get total request count
$totalRequest = getTotalRequest($conn);

// Update total request count
$sqlCount = "SELECT COUNT(*) AS total FROM request_documents";
$resultCount = $conn->query($sqlCount);
if ($resultCount->num_rows > 0) {
    $row = $resultCount->fetch_assoc();
    $totalRequest = $row["total"];
} else {
    $totalRequest = 0;
}

?>