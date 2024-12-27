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
    <link rel="stylesheet" href="healthcare.css">

    <!--script-->
    <script src="scriptt.js" defer></script>
</head>

<body>
<div class="bg-photo">
        <img src="images/background.jpg" alt="">
    </div>
    <div class="homepage" id="homepage">
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

            <div class="maps" id="map" role="application"
                aria-label="Interactive map of Barangay Libas, Lavezares, Northern Samar"></div>

            <div class="dashboard-area">
                <h2>Barangay Libas Healthcare Center</h2>
                <div class="map">
                    <button class="mapbutton" id="button">MAP</button>
                </div>
                <div class="pagelayout">
                    <div class="contain">
                        <img src="images/center.jpg" alt="">
                        <div class="hover">
                            <div class="hover1">
                                <h1>BARANGAY HEALTH STATION</h1>
                                <div class="seemore">
                                    <p>SEE MORE</p>
                                    <img src="images/arrow.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="contents" id="contents">
                            <h1 class="service" id="service">Services Offered</h1>
                            <div class="services">
                                <div class="column1">
                                    <h3>General Consultations</h3>
                                    <ul>
                                        <li>Medical check-ups</li>
                                        <li>Diagnosis and treatment of common illnesses (e.g., colds, flu, infections)
                                        </li>
                                        <li>Referrals to specialists</li>
                                    </ul>
                                    <h3>Maternal and Child Health Services</h3>
                                    <ul>
                                        <li>Prenatal care (e.g., pregnancy check-ups)</li>
                                        <li>Postnatal care (e.g., postpartum check-ups)</li>
                                        <li>Family planning services (e.g., contraception counseling and provision)</li>
                                    </ul>
                                </div>
                                <div class="column2">
                                    <h3>Chronic Disease Management</h3>
                                    <ol>
                                        <li>TB Monitoring</li>
                                        <ul>
                                            <li>Regular monitoring of treatment response through clinical evaluation
                                            </li>
                                            <li>Adjusting treatment regimens as needed based on drug susceptibility test
                                                results and clinical progress.</li>
                                        </ul>
                                    </ol>
                                    <p>Click <a href="announcement.php">here</a> to see announcement regarding health
                                        care events</p>
                                </div>
                            </div>

                            <h1 id="product">Products Available</h1>
                            <div class="products">
                                <div class="column1">

                                    <h3>Over-the-Counter (OTC) Medications</h3>
                                    <ol>
                                        <li>Pain Reliever <ul>
                                                <li>Paracetamol (fever reduction, pain relief)</li>
                                                <li>Medicol</li>
                                                <li>Advil</li>
                                            </ul>
                                        </li>
                                        <li>Cough and Cold Medications
                                            <ul>
                                                <li>Biogesic (fever reduction, pain relief)</li>
                                                <li>Solmux (cough suppressant)</li>
                                                <li>Decolgen Forte (nasal suppressant)</li>
                                            </ul>
                                        </li>
                                    </ol>

                                </div>
                                <div class="column2">
                                    <h3>Other Pharmaceuticals</h3>
                                    <ol>
                                        <li>Vitamins
                                            <ul>
                                                <li>Vitamins C (Immune System Support)</li>
                                                <li>Iron supplements</li>
                                                <li>Multivitamins (Support for Overall Health)</li>
                                            </ul>
                                        </li>
                                        <li>Contraceptives
                                            <ul>
                                                <li>Condom</li>
                                                <li>Birth control pills</li>
                                            </ul>
                                        </li>
                                    </ol>
                                    <ol>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    // JavaScript to toggle the visibility
                    document.getElementById('button').onclick = function () {
                        window.location.href = 'map.php';
                    };

                    document.querySelector('.hover').addEventListener('click', function () {
                        var contents = document.getElementById('contents');
                        contents.style.display = 'block';
                        this.style.display = 'none'; // Hide the .hover element
                        contents.scrollIntoView({ behavior: 'smooth' });

                        // Add a class to blur the content section
                        var contentSection = document.getElementById('contain');
                        contentSection.classList.add('blurred');
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
    
#loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 100px;
    height: 100px;
    margin: -76px 0 0 -76px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>

<script>
    var myVar;

    function loading() {
    myVar = setTimeout(showPage, 3000);
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("homepage").style.display = "block";
  }

</script>