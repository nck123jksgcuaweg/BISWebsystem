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
            <div id="loading-screen">
                <div class="loading-line"></div>
            </div>
            <div class="dashboard-area">
                <h2>Barangay Residents Records</h2>
                <div class="dashboard-box" id="dashboard-box">
                    <div class="residents-records">
                        <img src="images/house.png" alt="">
                        <div class="space"></div>
                        <div class="label">
                            <h4>TOTAL OF RESIDENTS</h4>
                            <div class="totalResident" style="font-size: 95px; text-align: center; font-weight: 700;">
                                <?php require_once "database.php";
                                echo isset($totalResidents) ? $totalResidents : '0'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="resident-list">
                        <form action="admin-residentsrecords.php" method="get">
                            <input type="text" name="query" placeholder="Enter name">
                            <button type="submit" class="searchBtn">Search</button>
                        </form>
                        <div class="residents-info-label">
                            <div class="resident-name-label">Name</div>
                            <div class="resident-gender-label">Gender</div>
                            <div class="resident-age-label">Age</div>
                            <div class="resident-contact-label">Contact No.</div>
                            <div class="resident-action-label">Action</div>
                        </div>

                        <div id="content">
                        <?php
                        // Fetch residents from the database
                        $sql = "SELECT * FROM `residentsrecords`";

                        $query = isset($_GET['query']) ? $_GET['query'] : '';

                        if (!empty($query)) {
                            if (strlen($query) === 1) {
                                // Search by first letter
                                $sql .= " WHERE fName LIKE '$query%'";
                            } else {
                                // Search by full name
                                $sql .= " WHERE CONCAT(fName, ' ', lName) LIKE '%$query%'";
                            }
                        }

                        $result = $conn->query($sql);

                        // Check if form is submitted by admin
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                            // Get form data
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $mname = $_POST['mname'];
                            $sname = $_POST['sname'];
                            $age = $_POST['age'];
                            $contact = $_POST['contact'];
                            $sex = $_POST['sex'];
                            $citizenship = $_POST['citizenship'];
                            $national_ID = $_POST['national_ID'];
                            $birthmonth = $_POST['birthmonth'];
                            $birthday = $_POST['birthday'];
                            $birthyear = $_POST['birthyear'];
                            $birthplace = $_POST['birthplace'];
                            $occupation = $_POST['occupation'];
                            $email = $_POST['email'];
                            $houseNum = $_POST['houseno'];
                            $purok = $_POST['purok'];
                            $barangay = $_POST['barangay'];
                            $municipality = $_POST['municipality'];
                            $province = $_POST['province'];

                            $targetDirectory = "uploads/";
                            $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                            // Check if file already exists
                            if (file_exists($targetFile)) {
                                //echo "Sorry, file already exists.";
                                $uploadOk = 0;
                            }

                            // Directory where uploaded files will be saved
                            $uploadDir = "uploads/";

                            // Check if the directory exists, if not, create it
                            if (!file_exists($uploadDir)) {
                                mkdir($uploadDir, 0777, true); // Recursive directory creation
                            }

                            

                            if ($_FILES["photo"]["size"] > 50000000) {;
                                $uploadOk = 0;
                            }

                            // Check if $uploadOk is set to 0 by an error
                            if ($uploadOk == 0) {;
                                // if everything is ok, try to upload file
                            } else {
                                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                                    //echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
                                }
                            }

                            $photoPath = $targetFile; // Use the path where the file is stored
                        
                            // Insert the file path into the database along with other form data
                            $stmt = $conn->prepare("INSERT INTO residentsrecords (fName, lName, mName, sName, sex, age, contact, birthmonth, birthday, birthyear, birthplace, citizenship, national_ID, occupation, email, houseNum, purok, barangay, municipality, province, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("sssssisssssssssssssss", $fname, $lname, $mname, $sname, $sex, $age, $contact, $birthmonth, $birthday, $birthyear, $birthplace, $citizenship, $national_ID, $occupation, $email, $houseNum, $purok, $barangay, $municipality, $province, $photoPath);

                            // Execute the statement
                            if ($stmt->execute()) {
                                //echo "Added successfully.";

                                // Update total residents count
                                $sqlCount = "SELECT COUNT(*) AS total FROM residentsrecords";
                                $resultCount = $conn->query($sqlCount);
                                if ($resultCount->num_rows > 0) {
                                    $row = $resultCount->fetch_assoc();
                                    $totalResidents = $row["total"];
                                } else {
                                    $totalResidents = 0;
                                }
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                        }
                        
                        // Check if residents exist
                        if ($result->num_rows > 0) {
                            // Output data of each resident
                            while ($row = $result->fetch_assoc()) {
                                $fullName = $row["fName"] . ' ' . $row["mName"] . ' ' . $row["lName"] . ' ' . $row["sName"];
                                $fname = $row["fName"];
                                $lname = $row["lName"];
                                $mname = $row["mName"];
                                $sname = $row["sName"];
                                $age = $row["age"];
                                $sex = $row["sex"];
                                $birthdate = $row["birthmonth"] . ' ' . $row["birthday"] . ' ' . $row["birthyear"];
                                $birthplace = $row["birthplace"];
                                $contact = $row["contact"];
                                $email = $row["email"];
                                $citizenship = $row["citizenship"];
                                $national_ID = $row["national_ID"];
                                $occupation = $row["occupation"];
                                $houseNo = $row["houseNum"];
                                $purok = $row["purok"];
                                $barangay = $row["barangay"];
                                $municipality = $row["municipality"];
                                $province = $row["province"];
                                $photo_path = $row["photo_path"];

                                $residentData = json_encode($row); // Encode the data to JSON format
                                $residentData = htmlspecialchars($residentData, ENT_QUOTES, 'UTF-8');

                                // Output HTML for each resident
                                echo '<div class="residents-info">';
                                // Display the resident photo
                                echo '<div class="resident-image">';
                                echo '<img src="' . $photo_path . '" alt="Resident Photo">';
                                echo '</div>';
                                echo '<div class="resident-name">' . $fullName . '</div>';
                                echo '<div class="resident-gender">' . $sex . '</div>';
                                echo '<div class="resident-age">' . $age . '</div>';
                                echo '<div class="resident-contact">' . $contact . '</div>';
                                echo '<button  onclick="editResident(' . $residentData . ')">Edit</button>';
                                echo '</div>';
                            }
                        } else {
                            // If no residents found
                            echo '<div class="not-found"><h3>No residents available.<h3></div>';
                        }

                        // Close connection
                        $conn->close();
                        ?>

                        </div>
                    </div>

                </div>
            </div>

            <div id="viewInformation1" class="view-informationA">
                <!-- view information content will be populated by JavaScript -->
            </div>

            <div class="officials-form-sec" id="updateForm"></div>

            <div class="officials-form-sec" id="officialForm">
                <div class="officials-form" style="margin-top: 3rem;">
                    <h1>New Resident Registration Form</h1>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-area">
                            <div class="image">
                                <div class="avatar" id="avatar">
                                    <img src="avatar.jpg" alt="">
                                </div>
                                <label for="photo" class="upload-btn">Upload Photo</label><br>
                                <input type="file" id="photo" name="photo" accept="image/*"><br>

                                <script>
                                    document.getElementById('photo').addEventListener('change', function (event) {
                                        const preview = document.getElementById('avatar');
                                        const file = event.target.files[0];
                                        const reader = new FileReader();

                                        reader.addEventListener('load', function () {
                                            const image = new Image();
                                            image.src = reader.result;
                                            preview.innerHTML = '';
                                            preview.appendChild(image);
                                        }, false);

                                        if (file) {
                                            reader.readAsDataURL(file);
                                        }
                                    });
                                </script>
                            </div>

                            <div class="info-data">
                                <h1>Personal Information</h1>
                                <div class="info-area">
                                    <input type="text" id="fname" placeholder="First Name" name="fname" required>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Middle Name" id="mname" name="mname"><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Last Name" id="lname" name="lname" required><br>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Suffix Name" id="sname" name="sname"><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Age" id="age" name="age" required><br>
                                    <div class="space"></div>
                                    <select name="sex" id="sex" required>
                                        <option value="00" disabled selected>Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select><br>
                                </div>
                                <div class="info-area">
                                    <select name="birthmonth" id="birthmonth" required>
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
                                    <div class="space"></div>
                                    <select name="birthday" id="birthday" required>
                                        <option value="" disabled selected>Birth Day</option>
                                        <!-- Days from 1 to 31 -->
                                        <script>
                                            for (var day = 1; day <= 31; day++) {
                                                document.write('<option value="' + (day < 10 ? '0' + day : day) + '">' + day + '</option>');
                                            }
                                        </script>
                                    </select>
                                    <div class="space"></div>
                                    <select name="birthyear" id="birthyear" required>
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
                                </div>
                                <div class="info-area">
                                    <input id="birthplace" type="text" placeholder="Birth Place" name="birthplace"><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Citizenship" id="citizenship" name="citizenship"
                                        required><br>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Occupation" id="occupation" name="occupation"
                                        required><br>
                                </div>
                                <div class="info-area" style="padding-bottom: 2rem;">
                                    <input id="nationalId" type="text" placeholder="National ID" name="national_ID"><br>
                                </div>
                                <h1>Contact Information</h1>
                                <div class="info-area">
                                    <input type="text" placeholder="Contact No." id="contact" name="contact" required>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Email" id="email" name="email" type="email"
                                        required><br>
                                </div>
                            </div>
                            <div class="info-data">
                                <h1>Address</h1>
                                <input type="text" id="houseno" placeholder="House No./Street" name="houseno" required>
                                <input type="text" placeholder="Purok" id="purok" name="purok" required><br>
                                <input type="text" placeholder="Barangay" id="barangay" name="barangay" required><br>
                                <input type="text" placeholder="Municipality" id="municipality" name="municipality"
                                    required><br>
                                <input type="text" placeholder="Province" id="province" name="province" required
                                    style="margin-bottom: 2rem;"><br>
                                    <h1>Health Information</h1>
                                <div class="info-area">
                                    <input type="text" placeholder="Blood Type" id="bloodtype" name="bloodtype">
                                    <div class="space"></div>
                                    <input type="text" placeholder="Allergies" id="allergies" name="allergies"><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Medical History" id="medicalhistory" name="medicalhistory">
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" name="submit">Add</button>
                            <button onclick="closeView()">Close</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="add" id="addOff" onclick="addOfficial()">
                <img src="images/addsign.png" alt="">
            </div>
        </div>
    </div>
    <div class="footer">
        <footer>eBARANGAY &copy 2024 </footer>
    </div>
</body>

</html>

<style>
    
    .view-informationA {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        padding-top: 2rem;
        visibility: hidden;
        transition: opacity 0.24s ease, visibility 0.4s ease;
        opacity: 0;
    }

    .view-informationA.show {
        visibility: visible;
        opacity: 1;
    }

</style>

<script>
    function editResident(residentData) {
        var data = residentData;
        var view = document.getElementById('updateForm');
        
        view.innerHTML = `
                <div class="officials-form">
                    <h1>Update Resident Information</h1>
                    <hr>
                    <form action="update-resident.php" method="post" enctype="multipart/form-data">
                    
                    <input type="hidden" name="residentId" value="${data.residentId}">
                        <div class="form-area">
                            <div class="image">
                                <div class="avatar" id="avatar">
                                    <img src="${data.photo_path}" alt="">
                                </div>
                                <label for="photo" class="upload-btn">Upload Photo</label><br>
                                <input type="file" id="photo" name="photo" accept="image/*"><br>
                            </div>

                            <div class="info-data">
                                <h1>Personal Information</h1>
                                <div class="info-area">
                                    <input type="text" id="fname" placeholder="First Name" name="fname" value="${data.fName}" required>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Middle Name" id="mname" name="mname" value="${data.mName}"><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Last Name" id="lname" name="lname" value="${data.lName}" required><br>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Suffix Name" id="sname" name="sname" value="${data.sName}"><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Age" id="age" name="age" value="${data.age}" required><br>
                                    <div class="space"></div>
                                    <select name="sex" id="sex" required>
                                        <option value="00" disabled selected>Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select><br>
                                </div>
                                <div class="info-area">
                                    <select name="birthmonth" id="birthmonth" required>
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
                                    <div class="space"></div>
                                    <select name="birthday" id="birthday" required>
                                        <option value="" disabled selected>Birth Day</option>
                                    </select>
                                    <div class="space"></div>
                                    <select name="birthyear" id="birthyear" required>
                                        <option value="" disabled selected>Birth Year</option>
                                    </select>
                                </div>
                                <div class="info-area">
                                    <input id="birthplace" type="text" placeholder="Birth Place" name="birthplace" value="${data.birthplace}"><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Citizenship" id="citizenship" name="citizenship" value="${data.citizenship}"
                                        required><br>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Occupation" id="occupation" name="occupation" value="${data.occupation}"
                                        required><br>
                                </div>
                                <div class="info-area" style="padding-bottom: 2rem;">
                                    <input id="nationalId" type="text" placeholder="National ID" name="national_ID" value="${data.national_ID}"><br>
                                </div>
                                <h1>Contact Information</h1>
                                <div class="info-area">
                                    <input type="text" placeholder="Contact No." id="contact" name="contact" value="${data.contact}" required>
                                    <div class="space"></div>
                                    <input type="text" placeholder="Email" id="email" name="email" type="email" value="${data.email}"
                                        required><br>
                                </div>
                            </div>
                            <div class="info-data">
                                <h1>Address</h1>
                                <input type="text" id="houseno" placeholder="House No./Street" name="houseno" value="${data.houseNum}" required>
                                <input type="text" placeholder="Purok" id="purok" name="purok" value="${data.purok}" required><br>
                                <input type="text" placeholder="Barangay" id="barangay" name="barangay" value="${data.barangay}" required><br>
                                <input type="text" placeholder="Municipality" id="municipality" value="${data.municipality}" name="municipality"
                                    required><br>
                                <input type="text" placeholder="Province" id="province" name="province" value="${data.province}" required
                                    style="margin-bottom: 2rem;"><br>
                                <h1>Health Information</h1>
                                <div class="info-area">
                                    <input type="text" placeholder="Blood Type" id="bloodtype" name="bloodtype" value="${data.bloodtype}">
                                    <div class="space"></div>
                                    <input type="text" placeholder="Allergies" id="allergies" name="allergies" type="allergies" value="${data.allergies}"
                                        ><br>
                                </div>
                                <div class="info-area">
                                    <input type="text" placeholder="Medical History" id="medicalhistory" name="medicalhistory" value="${data.medicalhistory}">
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <form action="update-resident.php" method="post">
                                <button type="submit" name="submit">Update</button>
                                <button class="closeView" onclick="closeView()">Close</button>
                            </form>
                        </div>
                    </form>
                </div>
        `;

        document.getElementById('photo').addEventListener('change', function (event) {
            const preview = document.getElementById('avatar');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', function () {
                const image = new Image();
                image.src = reader.result;
                preview.innerHTML = '';
                preview.appendChild(image);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });

         // Populate days
        var birthdaySelect = document.getElementById('birthday');
        for (var day = 1; day <= 31; day++) {
            var option = document.createElement('option');
            option.value = day < 10 ? '0' + day : day;
            option.text = day;
            birthdaySelect.appendChild(option);
        }

        // Populate years
        var birthyearSelect = document.getElementById('birthyear');
        var startYear = 1900;
        var endYear = new Date().getFullYear();
        for (var year = endYear; year >= startYear; year--) {
            var option = document.createElement('option');
            option.value = year;
            option.text = year;
            birthyearSelect.appendChild(option);
        }

        // Set selected values for day and year if available
        if (data.birthday) {
            birthdaySelect.value = data.birthday;
        }
        if (data.birthyear) {
            birthyearSelect.value = data.birthyear;
        }

        view.classList.toggle('show');
        

        var button = document.getElementsByClassName("closeView")[0];
        button.onclick = function () {
            view.classList.remove('show');
        }
    }

    function deleteResident(residentData, residentId) {
        if (confirm('Are you sure you want to delete this resident?')) {
            window.location.href = `delete-resident.php?residentId=${residentId}`;
        }
    }

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