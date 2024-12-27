<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
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

$sql = "SELECT * FROM statistics WHERE id=1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$households = $data['households'];
$families = $data['families'];
$population = $data['population'];
$males = $data['males'];
$females = $data['females'];
$elementary = $data['elementary'];
$secondary = $data['secondary'];
$tertiary = $data['tertiary'];
$out_of_school = $data['out_of_school'];
$households = $data['households'];
$govEmployee = $data['govEmployee'];
$casEmployee = $data['casEmployee'];
$selfEmployed = $data['selfEmployed'];
$fishing = $data['fishing'];
$fishVendor = $data['fishVendor'];
$farmers = $data['farmers'];
$laborer = $data['laborer'];
$sarisari = $data['sarisari'];
$business = $data['business'];
$pdCab = $data['pdCab'];
$triDriver = $data['triDriver'];
$habalhabal = $data['habalhabal'];
$jeepneyDriver = $data['jeepneyDriver'];
$carpenter = $data['carpenter'];
$seaFarers = $data['seaFarers'];
$ofw = $data['ofw'];
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
                <h2>Barangay Statistics and Data</h2>
                <div class="dashboard-box" id="cert-clearance">
                <div class="chart-area">
                    <div class="chart-box">
                    <h1>COMMUNITY DATA</h1>
                        <div class="charts">
                        <div class="chart">
                        <canvas id="pieChart" width="300" height="300"></canvas>
                        </div>
                        <div class="chart">
                            <canvas id="pieChart1" width="300" height="300"></canvas>
                        </div>
                        <div class="chart">
                            <canvas id="pieChart2" width="300" height="300"></canvas>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="barchart">
                    <canvas id="myChart" width="200" height="100"></canvas>
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
    .chart-area {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: auto;
    }

    .chart-area .chart-box {
        width: 90%;
        height: auto;
        background-color: whitesmoke;
        margin: 2rem;
        border-radius: 10px;
    }

    .chart-area .chart-box h1 {
        text-align: center;
        padding-top: 2rem;
        font-size: 20px;
    }

    .chart-area .charts {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
    }


    .chart-area .space {
        width: 20%;
    }

    .chart {
        flex: 1; /* Equal width for each chart */
        padding: 10px; /* Padding to prevent charts from sticking to each other */
    }

    .chart canvas {
        width: 100% !important; /* Ensures canvas takes the full width of its container */
        height: auto !important; /* Height is auto to maintain aspect ratio */
    }

    .barchart {
        width: 90%;
        height: auto;
        padding-bottom: 10rem;
        margin-top: 2rem;
        background-color: whitesmoke;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('pieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['No. of Household', 'No. of Families', 'No. of Population'],
                datasets: [{
                    label: 'TOTAL NUMBER',
                    data: [<?php echo $households; ?>, <?php echo $families; ?>, <?php echo $population; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    cutout: '50%'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                        }
                    },
                    title: {
                        display: true,
                        text: ''
                    }
                }
            }
        });

        var ctx1 = document.getElementById('pieChart1').getContext('2d');
        var myPieChart1 = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'TOTAL NUMBER',
                    data: [<?php echo $males; ?>, <?php echo $females; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    cutout: '50%'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                        }
                    },
                    title: {
                        display: true,
                        text: ''
                    }
                }
            }
        });

        var ctx2 = document.getElementById('pieChart2').getContext('2d');
        var myPieChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Elementary Grade', 'Secondary Level', 'Tertiary Level', 'Out of School'],
                datasets: [{
                    label: 'TOTAL NUMBER',
                    data: [<?php echo $elementary; ?>, <?php echo $secondary; ?>, <?php echo $tertiary; ?>, <?php echo $out_of_school; ?>],
                    backgroundColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    cutout: '50%'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                        }
                    },
                    title: {
                        display: true,
                        text: ''
                    }
                }
            }
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Government Employees', 'Casual Employees', 'Self Employed', 'Fishing', 'Fish Vendor', 'Farmers', 'Laborer', 'Sari-Sari Store', 'W/ Business', 'PD Cab Driver', 'Tricycle Driver', 'Habal-Habal', 'Jeepner Driver', 'Carpenter', 'Sea Farers', 'OFW'],
                datasets: [{
                    label: 'TOTAL NUMBER',
                    data: [<?php echo $govEmployee; ?>, <?php echo $casEmployee; ?>, <?php echo $selfEmployed; ?>, <?php echo $fishing; ?>, <?php echo $fishVendor; ?>, <?php echo $farmers; ?>, <?php echo $laborer; ?>, <?php echo $sarisari; ?>, <?php echo $business; ?>, <?php echo $pdCab; ?>, <?php echo $triDriver; ?>, <?php echo $habalhabal; ?>, <?php echo $jeepneyDriver; ?>, <?php echo $carpenter; ?>, <?php echo $seaFarers; ?>, <?php echo $ofw; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 105, 0.2)',
                        'rgba(127, 0, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 105, 1)',
                        'rgba(127, 0, 255, 1)'
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 200,
                        ticks: {
                            stepSize: 10  // Set the step size to 5
                        }
                    }
                }
            }
        });
    });
</script>