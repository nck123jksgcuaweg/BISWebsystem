
<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
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
        <div class="main-page" id="main-page" style="position: fixed;">
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

            <div class="dashboard-area">
                <h2>Dashboard</h2>
                <div class="dashboard-box">
                    <a href="admin-officials.php" class="box1" id="box">
                        <div class="dashboard-link">
                        <img src="images/group.png" alt="">
                        <div class="area" style="height: 1rem;">
                            <p style="margin-top: -2rem;">OFFICIALS AND STAFFS</p>
                            <div class="totalResident" style="font-size: 60px; font-weight: 700; color: #000000;">
                                <?php require_once "database.php";
                                echo isset($totalOfficials) ? $totalOfficials : '0'; ?>
                            </div>
                        </div>
                        </div>
                        <div class="view-more"><h5>VIEW MORE</h5></div>
                    </a>
                    <a href="admin-residentsrecords.php" class="box2" id="box">
                        <div class="dashboard-link">
                        <img src="images/house.png" alt="">
                        <div class="area" style="height: 1rem;">
                            <p style="margin-top: -2rem;">RESIDENTS</p>
                            <div class="totalResident" style="font-size: 60px; font-weight: 700; color: #000000;">
                                <?php require_once "database.php";
                                echo isset($totalResidents) ? $totalResidents : '0'; ?>
                            </div>
                        </div>
                        </div>
                        <div class="view-more"><h5>VIEW MORE</h5></div>
                    </a>

                    <a href="admin-announcement.php" class="box3" id="box">
                        <div class="dashboard-link">
                        <img src="images/megaphone.png" alt="">
                        <div class="area" style="height: 1rem;">
                            <p style="margin-top: -2rem;">ANNOUNCEMENTS</p>
                            <div class="totalResident" style="font-size: 60px; font-weight: 700; color: #000000;">
                                <?php require_once "database.php";
                                echo isset($totalAnnouncement) ? $totalAnnouncement : '0'; ?>
                            </div>
                        </div>
                        </div>
                        <div class="view-more"><h5>VIEW MORE</h5></div>
                    </a>
                </div>
                <div class="dashboard-box1">
                    <a href="admin-healthcare.php" class="box1" id="box">
                        <div class="dashboard-link">
                            <img src="images/first-aid-kit.png" alt="" style="width: 20%;">
                            <div class="area" style="height: 1rem;">
                                <p style="margin-top: -1rem;">HEALTHCARE PRODUCTS <br> & SERVICES</p>
                            </div>
                        </div>
                        <div class="view-more">
                            <h5>VIEW MORE</h5>
                        </div>
                    </a>
                    <a href="admin-statistics.php" class="box2" id="box">
                        <div class="dashboard-link">
                            <img src="images/pie-chart.png" alt="" style="width: 20%;">
                            <div class="area" style="height: 1rem;">
                                <p style="margin-top: -1rem;">BARANGAY STATISTICS</p>
                            </div>
                        </div>
                        <div class="view-more">
                            <h5>VIEW MORE</h5>
                        </div>
                    </a>

                    <a href="admin-requestdocs.php" class="box3" id="box">
                        <div class="dashboard-link">
                            <img src="images/file.png" alt="" style="width: 20%;">
                            <div class="area" style="height: 1rem;">
                                <p style="margin-top: -1rem;">CERTIFICATE & CLEARANCE</p>
                                <div class="totalResident" style="font-size: 60px; font-weight: 700; color: #000000;">
                                <?php require_once "database.php";
                                echo isset($totalRequest) ? $totalRequest : '0'; ?>
                            </div>
                            </div>
                        </div>
                        <div class="view-more">
                            <h5>VIEW MORE</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <footer>eBARANGAY &copy 2024 </footer>
    </div>
</body>

</html>

<style>
    .dashboard-box .box1 {
        transition: 0.4s;
    }

    .dashboard-box .box1:hover {
        transition: 0.4s;
        margin-top: 0.2%;
        box-shadow: 0 10px 10px 0 rgb(90, 90, 90);
    }

    .dashboard-box .box2 {
        transition: 0.4s;
    }

    .dashboard-box .box2:hover {
        transition: 0.4s;
        margin-top: 0.2%;
        box-shadow: 0 10px 10px 0 rgb(90, 90, 90);
    }

    .dashboard-box .box3 {
        transition: 0.4s;
    }

    .dashboard-box .box3:hover {
        transition: 0.4s;
        margin-top: 0.2%;
        box-shadow: 0 10px 10px 0 rgb(90, 90, 90);
    }
</style>