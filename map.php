<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

require_once "database.php";

$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each resident
    while ($row = $result->fetch_assoc()) {
        $fullName = $row["firstName"] . ' ' . $row["lastName"];
        $age = $row["age"];
        $sex = $row["sex"];
        $contact = $row["contact"];
        $address = $row["address"];
        $users_profile = $row["users_profile"];
        $username = $row["username"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBarangay</title>

    <!--stylesheet-->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">

    <!--script-->
    <script src="scriptt.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body>
<div class="bg-photo">
        <img src="images/background.jpg" alt="">
    </div>
    <div class="homepage">
        <nav class="menu" id="menu" aria-label="Main navigation">
            <div class="menu-header">
                <img src="images/logo.png" alt="eBarangay Logo" role="img" aria-label="eBarangay Logo"
                    onclick="logo1()">
                <address>Brgy. Libas, <br> Lavezares, N. Samar</address>
            </div>
            <div class="menu-selection">
                <h3>DASHBOARD</h3>
                <form action="home.php" method="post">
                    <button type="submit" aria-label="Go to Dashboard">Dashboard</button>
                </form>
                <h3>MENU</h3>
                <form action="officials&staff.php" method="post">
                    <button type="submit" aria-label="View Barangay Officials and Staffs">Barangay Officials &
                        Staffs</button>
                </form>
                <form action="residents-records.php" method="post">
                    <button type="submit" aria-label="View Residents Records">Residents Records</button>
                </form>
                <form action="certificate&clearance.php" method="post">
                    <button type="submit" aria-label="View Certificates and Clearances">Certificate and
                        Clearance</button>
                </form>
                <form action="announcement.php" method="post">
                    <button type="submit" aria-label="View Announcements">Announcements</button>
                </form>
                <form action="about.php" method="post">
                    <button type="submit" aria-label="Learn About eBarangay">About</button>
                </form>
            </div>
        </nav>
        <div class="main-page" id="main-page">
            <div class="header">
                <i class="bi bi-filter-left" onclick="menu()"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="80" onclick="menu()" height="40" fill="#fff"
                    class="bi bi-filter-left" viewBox="0 0 16 16">
                    <path
                        d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>
                <h1>eBARANGAY</h1>
                <div class="space"></div>
                <div class="user-profile-header"
                    style="width: 6vh; height: 6vh; background-color: white; border-radius: 50px; margin-right: 2rem; overflow: hidden; border-radius: 50%;"
                    onclick="userProfile()">
                    <img src="<?php echo $users_profile ?>" alt="" style="object-fit: cover;">
                </div>
            </div>

            <div class="user" id="user">
                <div class="user-area">
                    <div class="user-info">
                        <div class="user-info1">
                            <h2>ACCOUNT</h2>
                            <hr>
                            <p>Name: <?php echo $fullName ?></p>
                            <p>Age: <?php echo $age ?></p>
                            <p>Gender: <?php echo $sex ?></p>
                            <p>Contact: <?php echo $contact ?></p>
                            <form action="edituser.php">
                                <button class="edit" type="submit">Edit</button>
                            </form>
                        </div>
                        <div class="space"></div>
                        <form action="logout.php">
                            <button type="submit">LOGOUT</button>
                        </form>
                    </div>
                    <div class="user-profile">
                        <div class="user-profile1">
                            <img src="<?php echo $users_profile ?>" alt="">
                        </div>
                        <div class="username">Username</div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>

            <div class="dashboard-area">
                <h2><a href="healthcenter.php" style="text-decoration: none; color: white;">< </a> MAP</h2>
                <div id="map" role="application"
                    aria-label="Interactive map of Barangay Libas, Lavezares, Northern Samar"></div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var map = L.map('map').setView([12.5465, 124.3976], 12); // Coordinates for Barangay Libas, Lavezares, Northern Samar

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                            maxZoom: 18,
                        }).addTo(map);

                        var marker = L.marker([12.5384, 124.3262]).addTo(map);
                        marker.bindPopup("<b>Barangay Libas, Lavezares, Northern Samar</b><br>Barangay Health Station").openPopup();
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="footer">
        <footer>eBARANGAY &copy 2024 </footer>
    </div>
</body>

</html>

<style>
    #map {
    height: 75vh; /* Adjust height as needed */
    width: 90%;/* Full width */
    margin: 5rem;
    margin-top: 1rem;
    z-index: 0;
}
</style>