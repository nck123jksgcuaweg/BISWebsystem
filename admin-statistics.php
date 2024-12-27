<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login-admin.php");
}

require_once "database.php";

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
    <link rel="stylesheet" href="admin-stylee.css">
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
                <h2>Barangay Statistics and Data</h2>
                <div class="dashboard-box" id="cert-clearance">
                    <div class="buttonStat">
                        <button onclick="updateStat()">UPDATE STATISTICS</button>
                    </div>
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
                <div class="update-form" id="updateForm">
                    <div class="update-content">
                        <h2>Update Statistics</h2><hr>
                        <form action="update-statistics.php" method="post">
                            <div class="form">
                                <div class="col1">
                                    <h3>Community Data</h3>
                                    <div class="form-group">
                                        <input type="number" id="households" name="households" placeholder=" " required
                                            aria-describedby="householdsDesc" value="<?php echo $households?>">
                                        <label for="households">Number of Households</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="households" name="families" placeholder=" " required
                                            aria-describedby="householdsDesc"  value="<?php echo $families?>">
                                        <label for="households">Number of Families</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="population" name="population" placeholder=" " required
                                            aria-describedby="householdsDesc" value="<?php echo $population?>">
                                        <label for="population">Population</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="males" name="males" placeholder=" " required
                                            aria-describedby="householdsDesc" value="<?php echo $males?>">
                                        <label for="males">Number of Male Population</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="females" name="females" placeholder=" " required
                                            aria-describedby="householdsDesc"  value="<?php echo $females?>">
                                        <label for="females">Number of Female Population</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="elementary" name="elementary" placeholder=" " required
                                            aria-describedby="householdsDesc" value="<?php echo $elementary?>">
                                        <label for="elementary">Elementary Grade</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="secondary" name="secondary" placeholder=" " required
                                            aria-describedby="householdsDesc" value="<?php echo $secondary?>">
                                        <label for="secondary">Secondary Level</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="tertiary" name="tertiary" placeholder=" " required
                                            aria-describedby="householdsDesc" value="<?php echo $tertiary?>">
                                        <label for="tertiary">Tertiary Level</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" id="out_of_school" name="out_of_school" placeholder=" "
                                            required aria-describedby="householdsDesc" value="<?php echo $out_of_school?>">
                                        <label for="out_of_school">Out of School</label>
                                    </div>

                                </div>

                                <div class="col2">
                                    <h3>Source of Income</h3>
                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="govEmployee" name="govEmployee" placeholder=" "
                                                required aria-describedby="householdsDesc" value="<?php echo $govEmployee?>">
                                            <label for="govEmployee">Government Employees</label>
                                        </div>

                                        <div class="space"></div>

                                        <div class="form-group">
                                            <input type="number" id="casEmployee" name="casEmployee" placeholder=" "
                                                required aria-describedby="householdsDesc" value="<?php echo $casEmployee?>">
                                            <label for="casEmployee">Casual Employees</label>
                                        </div>
                                    </div>

                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="selfEmployed" name="selfEmployed" placeholder=" "
                                                required aria-describedby="householdsDesc" value="<?php echo $selfEmployed?>">
                                            <label for="selfEmployed">Self Employed</label>
                                        </div>

                                        <div class="space"></div>

                                        <div class="form-group">
                                            <input type="number" id="fishing" name="fishing" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $fishing?>">
                                            <label for="fishing">Fishing</label>
                                        </div>
                                    </div>

                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="fishVendor" name="fishVendor" placeholder=" "
                                                required aria-describedby="householdsDesc" value="<?php echo $fishVendor?>">
                                            <label for="fishVendor">Fish Vendor</label>
                                        </div>

                                        <div class="space"></div>
                                        <div class="form-group">
                                            <input type="number" id="farmers" name="farmers" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $farmers?>">
                                            <label for="farmers">Farmers</label>
                                        </div>

                                    </div>

                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="laborer" name="laborer" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $laborer?>">
                                            <label for="laborer">Laborer</label>
                                        </div>
                                        <div class="space"></div>
                                        <div class="form-group">
                                            <input type="number" id="sarisari" name="sarisari" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $sarisari?>">
                                            <label for="sarisari">Sari-Sari Store</label>
                                        </div>
                                    </div>

                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="business" name="business" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $business?>">
                                            <label for="business">With Business</label>
                                        </div>
                                        <div class="space"></div>
                                        <div class="form-group">
                                            <input type="number" id="pdCab" name="pdCab" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $pdCab?>">
                                            <label for="pdCab">PD Cab Driver</label>
                                        </div>
                                    </div>

                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="tricycle" name="tricycle" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $triDriver?>">
                                            <label for="tricycle">Tricycle Driver</label>
                                        </div>
                                        <div class="space"></div>

                                        <div class="form-group">
                                            <input type="number" id="habalhabal" name="habalhabal" placeholder=" "
                                                required aria-describedby="householdsDesc" value="<?php echo $habalhabal?>">
                                            <label for="habalhabal">Habal-Habal </label>
                                        </div>
                                    </div>

                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="jeepneyDriver" name="jeepneyDriver" placeholder=" "
                                                required aria-describedby="householdsDesc" value="<?php echo $jeepneyDriver?>">
                                            <label for="jeepneyDriver">Jeepney Driver</label>
                                        </div>
                                        <div class="space"></div>
                                        <div class="form-group">
                                            <input type="number" id="carpenter" name="carpenter" placeholder=" "
                                                required aria-describedby="householdsDesc" value="<?php echo $carpenter?>">
                                            <label for="carpenter">Carpenter</label>
                                        </div>
                                    </div>

                                    <div class="area">
                                        <div class="form-group">
                                            <input type="number" id="seafarer" name="seafarer" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $seaFarers?>">
                                            <label for="seafarer">Sea Farers</label>
                                        </div>
                                        <div class="space"></div>
                                        <div class="form-group">
                                            <input type="number" id="ofw" name="ofw" placeholder=" " required
                                                aria-describedby="householdsDesc" value="<?php echo $ofw?>">
                                            <label for="ofw">OFW</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="updateBtn">
                                <button type="submit">Update</button>
                                <button onclick="cancel()">Cancel</button>
                            </div>
                        </div>
                    </form>
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

    /* Additional styles for showing the form */
    .update-form.show {
        opacity: 1;
        visibility: visible;
    }

    .update-form {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 30;
        top: 0;
        transition: opacity 0.4s ease, visibility 0.3s ease;
        opacity: 0; /* Initially hide the form */
        visibility: hidden;
    }

    .update-form .update-content {
        width: 65%;
        height: auto;
        background-color: #fff;
    }

    .update-form .update-content h2 {
        margin: unset;
        padding: 1rem;
        font-size: 17px;
    }

    .update-form .update-content .updateBtn {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: right;
    }

    .update-form .update-content .updateBtn button {
        width: 8%;
        height: 4vh;
        border: 1px solid #ccc;
        cursor: pointer;
        margin: 0.5rem;
        transition: 0.2s;
        color: #989898;
        font-weight: 500
    }

    .update-form .update-content .updateBtn button:hover {
        transition: 0.2s;
        background-color: #ccc;
    }

    .update-form .update-content .form {
        width: 100%;
        display: flex;
        flex-direction: row;
    }

    .update-form .update-content .col2 .area {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .update-form .update-content .col2 .area .space {
        width: 4%;
    }

    .col1 {
        margin-left: 1rem;
    }

    .update-content .form .col1,
    .update-content .form .col2 {
        padding: 2rem;
        width: 100%;
    }

    .update-content .form .col1 h3,
    .update-content .form .col2 h3 {
        color: #989898;
        margin-bottom: 1rem;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }

    input[type="number"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group label {
        position: absolute;
        left: 10px;
        top: 10px;
        transition: 0.3s ease;
        pointer-events: none;
        color: #999;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label {
        top: -10px;
        background: white;
        padding: 0 5px;
        color: #333;
        font-size: 12px;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }


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
        background-color: #fff;
        margin: 1rem;
        border-radius: 10px;
    }

    .chart-area .chart-box h1 {
        text-align: center;
        padding-top: 2rem;
        font-size: 20px;
    }

    .chart-area .charts {
        display: flex;
        align-items: enter;
        justify-content: center;
        flex-direction: row;
    }


    .chart-area .space {
        width: 20%;
    }

    .chart {
        flex: 1;
        /* Equal width for each chart */
        padding: 10px;
        /* Padding to prevent charts from sticking to each other */
    }

    .chart canvas {
        width: 100% !important;
        height: auto !important;
    }

    .barchart {
        width: 90%;
        height: auto;
        padding-bottom: 10rem;
        margin-top: 2rem;
        background-color: whitesmoke;
    }

    .buttonStat {
        width: 90%;
        height: 4vh;
        display: flex;
        justify-content: end;
        align-items: end;
    }

    .buttonStat button {
        width: 10%;
        height: 4vh;
        cursor: pointer;
        transition: 0.2s;
        border: 1px solid #ccc;
        color: #5f5f5f;
    }

    .buttonStat button:hover {
        transition: 0.2s;
        background-color: #d2cece;
    }
</style>

<script>
   function updateStat() {
        var updateForm = document.getElementById('updateForm');

        // Toggle the 'show' class to display/hide the form with transition
        updateForm.classList.toggle('show');
    }

    // Function to handle cancellation
    function cancel() {
        var updateForm = document.getElementById('updateForm');
        updateForm.classList.remove('show'); // Hide the form without transition
    }

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