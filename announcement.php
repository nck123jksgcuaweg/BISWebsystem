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
            <div class="announcement-area" id="content">
                <div class="dashboard-area">
                    <div class="dashboard-box" id="dashboard-box">
                        <div class="announcement">
                            <div class="announcement-list">
                            <?php
                            require_once "database.php";

                            // Retrieve announcements from database
                            $sql = "SELECT whatt, whoo, whenn, wheree, whyy FROM announcements ORDER BY id DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $what = $row["whatt"];
                                    $who = $row["whoo"];
                                    $why = $row["whyy"];
                                    $where = $row["wheree"];
                                    $when = $row["whenn"];
                                    
                                    // Output a separate <div> for each announcement
                                    echo '<div class="announcement1">';
                                    echo '<p><strong>What:</strong> ' . $what . '</p>';
                                    echo '<p>Who: ' . $who . '</p>';
                                    echo '<p>When: ' . $when . '</p>';
                                    echo '<p>Where: ' . $where . '</p>';
                                    echo '<p>Purpose: ' . $why . '</p>';
                                    echo '</div>';
                                }
                            } else {
                                // If no announcements available
                                echo '<div class="announcement1">';
                                echo '<h2 style="font-size: 20px; font-weight: 300;">No announcement available</h2>';
                                echo '</div>';
                            }
                            ?>

                            </div>
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

<style>
    /* announcement */
    .dashboard-box .announcement {
        width: 90%;
        height: 52vh;
        background-color: #306146;
        padding-top: 7rem;
        padding-left: 0.7rem;
        padding-right: 0.7rem;
        padding-bottom: 2.7rem;
        margin: 2rem;
        border-radius: 5px;
        border: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        color: #FFFFFF;
    }

    .dashboard-box .announcement1 {
        width: 95%;
        height: auto;
        background-color: #40785a;
        margin-top: 0.7rem;
        line-height: 0rem;
        padding-top: 2rem;
        padding-bottom: 2rem;
        border-radius: 5px;
        border: none;
        text-align: left;
        display: flex;
        flex-direction: column;
    }

    .announcement .announcement-list {
        overflow-y: scroll;
        scrollbar-color: #40785a #306146;
        width: 97%;
        margin-left: 2rem;
        
    }

    .dashboard-box .announcement::before {
        content: 'ANNOUNCEMENTS';
        width: 95.5%;
        height: 3vh;
        background-color: #40785a;
        text-align: left;
        position: absolute;
        top: 0;
        border-radius: 5px;
        padding: 2rem;
        font-size: 20px;
        font-weight: 700;
        box-shadow: 0 2px 2px 0 black;
    }

    .dashboard-box .announcement1 h2 {
        padding: 10rem;
        text-align: center;
        font-size: 19px;
        margin: 2.5rem;
        color: #FFFFFF;
    }

    .dashboard-box .announcement1 p {
        text-align: left;
        font-size: 25px;
        margin: 2.5rem;
        padding-left: 3rem;
        color: #FFFFFF;
    }
</style>

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