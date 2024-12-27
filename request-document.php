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


// Check if form is submitted by admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $sname = $_POST['sname'];
    $age = $_POST['age'];
    $birthmonth = $_POST['birthmonth'];
    $birthday = $_POST['birthday'];
    $birthyear = $_POST['birthyear'];
    $address = $_POST['address'];
    $documentType = $_POST['documentType'];
    $purpose = $_POST['purpose'];
    $status = $_POST['status'];

    // Generate a unique transaction ID
    $prefix = 'REQ-'; // Optional prefix for the transaction ID
    $transactionId = $prefix . uniqid();

    // Insert the file path into the database along with other form data
    $stmt = $conn->prepare("INSERT INTO request_documents (transaction_id, fname, mname, lname, sname, age, birthmonth, birthday, birthyear, address, documentType, purpose, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisssssss", $transactionId, $fname, $mname, $lname, $sname, $age, $birthmonth, $birthday, $birthyear, $address, $documentType, $purpose, $status);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Added successfully.";

        // Update total residents count
        $sqlCount = "SELECT COUNT(*) AS total FROM request_documents";
        $resultCount = $conn->query($sqlCount);
        if ($resultCount->num_rows > 0) {
            $row = $resultCount->fetch_assoc();
            $totalOfficials = $row["total"];
        } else {
            $totalOfficials = 0;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
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
        <div class="main-page" id="main-page" style="padding-bottom: 0;">
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
                <h2 style="font-weight: 600;">Request Barangay Document</h2>
                <div class="dashboard-box" id="req-certificate">
                    
                    <div class="requestBox">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="content">
                            <input type="text" placeholder="First Name" name="fname" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; margin-right: 2.5%; background-color: #CDCEA5; width: 70%; height: 1.2cm; border-radius: 5px; padding-left: 1%">
                            <input type="text" placeholder="Suffix" name="sname" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 25%; height: 1.2cm; border-radius: 5px; padding-left: 1%; "><br>
                            <input type="text" placeholder="Last Name" name="lname" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 99%; height: 1.2cm; border-radius: 5px; padding-left: 1%; margin-top: 1.5%;"><br>
                            <input type="text" placeholder="Middle Name" name="mname" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 99%; height: 1.2cm; border-radius: 5px; padding-left: 1%; margin-top: 1.5%"><br>
                            <select id="birthmonth" name="birthmonth" style="color: gray; margin-right: 2.5%; box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 25%; height: 1.2cm; border-radius: 5px; padding-left: 1%;">
                                <option value="01" disabled selected>Birth Month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                            <select name="birthday" id="birthday" style="color: gray; margin-right: 2.5%; box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 25%; height: 1.2cm; border-radius: 5px; padding-left: 1%;">
                                <option value="" disabled selected>Birth Day</option>
                                <!-- Days from 1 to 31 -->
                                <script>
                                    for (var day = 1; day <= 31; day++) {
                                        document.write('<option value="' + (day < 10 ? '0' + day : day) + '">' + day + '</option>');
                                    }
                                </script>
                            </select>
                            <select name="birthyear" id="birthyear" name="birthyear" style=" color: gray; margin-right: 2.5%; box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 25%; height: 1.2cm; border-radius: 5px; padding-left: 1%;">
                                <option value="" disabled selected>Birth Year</option>
                                <!-- Years from 1900 to 2024 -->
                                <!-- You can use a server-side script to generate these options dynamically -->
                                <script>
                                    var startYear = 1900;
                                    var endYear = new Date().getFullYear();
                                    for (var year = endYear; year >= startYear; year--) {
                                        document.write('<option value="' + year + '">' + year + '</option>');
                                    }
                                </script>
                            </select>
                            <input type="text" placeholder="Age" name="age" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 15%;height: 1.2cm; border-radius: 5px; padding-left: 1%; margin-top: 1.5%"><br>
                            <select id="status" name="status" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 100%; height: 1.2cm; border-radius: 5px; padding-left: 1%; margin-top: 1.5% ; color:gray;">
                                <option value="selection" selected disabled>Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="unmarried">Unmarried</option>
                                <option value="widow">Widow</option>
                            </select>
                            <input type="text" placeholder="Address" name="address" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 99%; height: 1.2cm; border-radius: 5px; padding-left: 1%; margin-top: 1.5%"><br>
                            <select id="documentType" name="documentType" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 100%; height: 1.2cm; border-radius: 5px; padding-left: 1%; margin-top: 1.5% ; color:gray;">
                                <option value="selection" selected disabled>Type of Document to Request</option>
                                <option value="Clearance">Barangay Clearance</option>
                                <option value="Residency">Barangay Residency</option>
                                <option value="Indigency">Barangay indigency</option>
                            </select>
                            <input type="text" placeholder="Purpose of Request" name="purpose" style="box-shadow: 0 2px 2px 0 rgb(188, 99, 99); border: #CDCEA5; background-color: #CDCEA5; width: 99%; height: 1.2cm; border-radius: 5px; padding-left: 1%; margin-top: 1.5%"><br>
                            <button style="color: gray; border-color: #badf27; box-shadow: 0 2px 2px 0 gray; background-color: #CDCEA5;  width: 10%; height: 1cm; border-radius: 5px; margin-bottom: -1%; margin-left: 45%; padding-left: 0%; margin-top: 1.5%" type="submit" name="submit">Submit</button>
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

    .dashboard-area #req-clearance .requestBox {
    background-color: #ABAC6D;
    width: 85%;
    padding: 2rem;
    position: relative;
    margin-top: 1%;
    padding-top: 4rem;
    font-size: 21px;
    font-weight: 400;
    color: #1e1e1e;
    height: auto;
    border-radius: 20px;
}

.dashboard-area #req-certificate .requestBox::before {
    content: "Barangay Document Request Form";
    font-family: judson;
    width: 98.9%;
    height: 5vh;
    position: absolute;
    background-color: #CDCEA5;
    left: 0;
    top: 0;
    border-radius: 15px;
    box-shadow: 0 2px 2px 0px rgb(124, 124, 124);
    padding-top: 10px;
    padding-left: 15px;
    font-size: 21px;
    font-weight: 500;
    color: #535353;
}

.dashboard-area #req-certificate .requestBox {
    background-color: #B9B995;
    width: 85%;
    padding: 2rem;
    position: relative;
    margin-top: 1%;
    padding-top: 4rem;
    font-size: 21   px;
    font-weight: 400;
    color: #1e1e1e;
    height: auto;
    border-radius: 20px;
    margin-bottom: 60px;
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
    }, 1000); // Adjust the delay as necessary (1500 milliseconds in this example)
});
</script>