<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login-admin.php");
}

require_once "database.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBarangay</title>

    <!--stylesheet-->
    <link rel="stylesheet" href="admin-stylee.css">
    <link rel="stylesheet" href="profilee.css">

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
                <img src="images/logo.png" alt="" onclick="logo()">
                <address>Brgy. Libas, <br> Lavezares, N. Samar</address>
            </div>
            <div class="menu-selection">
                <h3>DASHBOARD</h3>
                <form action="index.php" method="post">
                    <button type="submit">Dashboard</button>
                </form>
                <h3>MENU</h3>
                <form action="admin-officials.php" method="post">
                    <button type="submit">Barangay Officials & Staffs</button><br>
                </form>
                <form action="admin-residentsrecords.php" method="post">
                    <button type="submit">Residents Records</button><br>
                </form>
                <form action="admin-requestdocs.php" method="post">
                    <button type="submit">Certificate and Clearance</button><br>
                </form>
                <form action="admin-announcement.php" method="post">
                    <button type="submit">Announcements</button><br>
                </form>
                <form action="admin-about.php" method="post">
                    <button type="submit">About</button><br>
                </form>
            </div>
        </div>
        <div class="main-page" id="main-page" style="padding-bottom: unset;">
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
                    style="width: 8.1vh; height: 8.1vh; background-color: white; border-radius: 50px; margin-right: 2rem; overflow: hidden; border-radius: 50%;"
                    onclick="userProfile()">
                    <img src="images/user-icon.png" alt="" style="object-fit: cover;">
                </div>
            </div>
            <div class="user" id="user">
                <div class="user-area">
                    <div class="user-info">
                        <div class="user-info1">
                            <h2>ACCOUNT</h2>
                            <hr>
                            <p>ADMIN</p>
                        </div>
                        <div class="space"></div>
                        <form action="logout.php">
                            <button type="submit">LOGOUT</button>
                        </form>
                    </div>
                    <div class="user-profile">
                        <div class="user-profile1">
                            <img src="images/user-icon.png" alt="">
                        </div>
                        <div class="username">ADMIN</div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>
            <div id="loading-screen">
                <div class="loading-line"></div>
            </div>
            <div class="about" id="content">
                <div class="about-header">
                    <h1>ABOUT eBARANGAY</h1>
                </div>
                <div class="about-info">
                    <div class="info1">
                        <div class="welcome">
                            <p>Welcome to eBarangay, your comprehensive Barangay Information System designed to
                                streamline
                                community management and enhance communication within barangays.</p>
                        </div>
                        <div class="mission">
                            <h2>Our Mission</h2>
                            <p>At eBarangay, our mission is to revolutionize barangay governance by providing efficient,
                                transparent, and accessible tools for barangay officials and residents alike.</p>

                        </div>
                    </div>
                    <div class="info2">
                        <h2>What We Offer</h2>
                        <div class="what-we-offer">
                            <li><b>Digital Records Management:</b> Say goodbye to paper-based systems! eBarangay offers
                                a
                                digital platform for storing and managing essential barangay records, making information
                                retrieval quick and hassle-free.
                            </li>
                            <li><b>Community Engagement:</b> Foster stronger connections within your barangay with our
                                communication features. Whether it's disseminating announcements, organizing events, or
                                gathering feedback, eBarangay facilitates seamless interaction among barangay officials
                                and residents.
                            </li>
                            <li><b>Transparency and Accountability:</b> We believe in transparency as a cornerstone of
                                good
                                governance. With eBarangay, residents can access important barangay information and
                                updates, promoting accountability and trust between the community and its leaders.
                            </li>
                        </div>
                        <h2>Why Choose eBARANGAY</h2>
                        <div class="why-choose">
                            <li><b>User-Friendly Interface:</b> Our intuitive interface is designed with both barangay
                                officials and residents in mind, ensuring ease of use for all users.
                            </li>
                            <li><b>Security and Privacy:</b> Rest assured that your data is safe with us. eBarangay
                                employs
                                robust security measures to protect sensitive information and uphold user privacy.
                            </li>
                            <li><b>Continuous Support and Updates:</b>We are committed to providing ongoing support and
                                regular updates to ensure that eBarangay remains at the forefront of barangay management
                                technology.
                            </li>
                        </div>
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
    }, 350); // Adjust the delay as necessary (1500 milliseconds in this example)
});
</script>