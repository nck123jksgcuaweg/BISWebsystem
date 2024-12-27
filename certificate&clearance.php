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
</head>

<body>
<div class="bg-photo">
        <img src="images/background.jpg" alt="">
    </div>
    <div class="homepage">
        <div class="menu" id="menu">
            <div class="menu-header">
                <img src="images/logo.png" alt="" onclick="logo1()">
                <address>Brgy. Libas, <br> Lavezares, N. Samar</address>
            </div>
            <div class="menu-selection">
                <h3>DASHBOARD</h3>
                <form action="home.php" method="post">
                    <button type="submit">Dashboard</button>
                </form>
                <h3>MENU</h3>
                <form action="officials&staff.php" method="post">
                    <button type="submit">Barangay Officials & Staffs</button><br>
                </form>
                <form action="residents-records.php" method="post">
                    <button type="submit">Residents Records</button><br>
                </form>
                <form action="certificate&clearance.php" method="post">
                    <button type="submit">Certificate and Clearance</button><br>
                </form>
                <form action="announcement.php" method="post">
                    <button type="submit">Announcements</button><br>
                </form>
                <form action="about.php" method="post">
                    <button type="submit">About</button><br>
                </form>
            </div>
        </div>
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
            <div id="loading-screen">
                <div class="loading-line"></div>
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
                        <div class="username"><?php echo $username ?></div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>

            <div class="dashboard-area">
                <h2>Barangay Certificate and Clearance</h2>
                <div class="dashboard-box" id="cert-clearance">
                    <div class="boxA" id="content">
                        <li>
                            <ol>⬤ Step 1 - Request for a barangay documents. click here to <a href="request-document.php">request</a></ol>
                            <ol>⬤ Step 2 - Look for the barangay secretary at the barangay hall and submit
                                necessary requirements — ( Cedula )</ol>
                            <ol>⬤ Step 3 - Pay the necessary fee for the issuance of your requested Barangay Documents.</ol>
                            <ol>⬤ Step 4 - Claim your documents.</ol>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <footer>eBARANGAY &copy 2024 </footer>
    </div>
</body>
</html>

<script>
    // Add this to your existing script.js
document.addEventListener("DOMContentLoaded", function() {
    const loadingScreen = document.getElementById('loading-screen');
    const content = document.getElementById('content');
    
    // Adding a delay to ensure the loading screen stays visible for a brief moment
    setTimeout(() => {
        loadingScreen.style.display = 'none';
        content.style.display = 'block';
    }, 400); // Adjust the delay as necessary (1500 milliseconds in this example)
});
</script>