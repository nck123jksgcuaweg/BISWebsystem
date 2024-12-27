<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

// Include the database connection
require_once "database.php";

// Fetch the officials from the database
$sqlOfficials = "SELECT * FROM barangay_officials";
$resultOfficials = $conn->query($sqlOfficials);

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

            <div class="dashboard-area">
                <h2>Barangay Official and Staff</h2>
                <div class="dashboard-box" id="dashboard-box">
                    <div class="official-staff">
                        <img src="images/house.png" alt="">
                        <div class="space"></div>
                        <div class="label">
                            <h4>OFFICIALS AND STAFFS</h4>
                            <div class="totalofficials" style="font-size: 95px; text-align: center; font-weight: 700;">
                                <?php require_once "database.php";
                                echo isset($totalOfficials) ? $totalOfficials : '0'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="official-staff-info">
                        <div class="brgy-list">
                            <div class="brgy-info-label">
                                <div class="brgy-name-label" style="padding-left: 9rem;">Name</div>
                                <div class="brgy-position-label" style="padding-left: 4rem;">Position</div>
                                <div class="brgy-age-label" style="padding-right: 3rem;">Start of Term</div>
                                <div class="brgy-eterm-label" style="padding-right: 3.7rem;">End of Term</div>
                            </div>

                          <div class="info" id="content">
                          <?php
                            require_once "database.php";

                            // Fetch residents from the database
                            $sql = "SELECT * FROM barangay_officials";
                            $result = $conn->query($sql);

                            // Check if residents exist
                            if ($result->num_rows > 0) {
                                // Output data of each resident
                                while ($row = $result->fetch_assoc()) {

                                    // Output HTML for each resident
                                    echo '<div class="brgy-info">';
                                    // Display the resident photo
                                    echo '<div class="officials-image">';
                                    echo '<img src="' . $row["profile_image"] . '" alt="brgy Photo">';
                                    echo '</div>';
                                    echo '<div class="brgy-name">' . $row['full_name'] . '</div>';
                                    echo '<div class="brgy-position" style="width: 49%;">' . $row["position"] . '</div>';
                                    echo '<div class="brgy-gender">' . $row["term_start"] . '</div>';
                                    echo '<div class="brgy-eterm">' . $row['term_end'] . '</div>';
                                    echo '</div>';
                                }
                            } else {
                                // If no residents found
                                echo '<div class="not-found"><h3>No barangay officials/staff available.<h3></div>';
                            }

                            // Close connection
                            $conn->close();
                            ?>

                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="viewInformation" class="view-information">
                <!-- view information content will be populated by JavaScript -->
                <!-- Information of a specific resident will shown here -->
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
        content.style.display = 'flex';
    }, 1000); // Adjust the delay as necessary (1500 milliseconds in this example)
});
</script>