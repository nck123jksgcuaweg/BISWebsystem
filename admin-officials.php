<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login-admin.php");
}

require_once "database.php";

// Fetch the officials from the database
$sqlOfficials = "SELECT * FROM barangay_officials";
$resultOfficials = $conn->query($sqlOfficials);

// Check if form is submitted by admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data
    $fullname = $_POST['fullname'];
    $position = $_POST['position'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $startterm = $_POST['startterm'];
    $endterm = $_POST['endterm'];
    $sex = $_POST['sex'];

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Directory where uploaded files will be saved
    $uploadDir = "uploads/";

    // Check if the directory exists, if not, create it
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Recursive directory creation
    }


    // Check file size
    if ($_FILES["photo"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    $photoPath = $targetFile; // Use the path where the file is stored

    // Insert the file path into the database along with other form data
    $stmt = $conn->prepare("INSERT INTO barangay_officials (full_name, position, age, sex, term_end, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $fullname, $position, $age, $sex, $endterm, $photoPath);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Added successfully.";

        // Update total residents count
        $sqlCount = "SELECT COUNT(*) AS total FROM barangay_officials";
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
                <h2>Barangay Official and Staff</h2>
                <div class="dashboard-box" id="dashboard-box">
                    <div class="official-staff">
                        <img src="images/group.png" alt="">
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
                                <div class="brgy-name-label">Name</div>
                                <div class="brgy-position-label">Position</div>
                                <div class="brgy-gender-label">Gender</div>
                                <div class="brgy-age-label">Age</div>
                                <div class="brgy-eterm-label">End of Term</div>
                                <div class="brgy-action-label">Action</div>
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
                                        $officialData = json_encode($row); // Encode the data to JSON format
                                        $officialData = htmlspecialchars($officialData, ENT_QUOTES, 'UTF-8');

                                        // Output HTML for each resident
                                        echo '<div class="brgy-info">';
                                        // Display the resident photo
                                        echo '<div class="officials-image">';
                                        echo '<img src="' . $row["profile_image"] . '" alt="brgy Photo">';
                                        echo '</div>';
                                        echo '<div class="brgy-name">' . $row['full_name'] . '</div>';
                                        echo '<div class="brgy-position">' . $row["position"] . '</div>';
                                        echo '<div class="brgy-age">' . $row["sex"] . '</div>';
                                        echo '<div class="brgy-gender">' . $row["age"] . '</div>';
                                        echo '<div class="brgy-eterm">' . $row['term_end'] . '</div>';
                                        echo '<button  onclick="editResident(' . $officialData . ')">UPDATE</button>';
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

            <div class="officials-form-sec1" id="updateForm"></div>

            <div class="officials-form-sec1" id="officialForm">
                <div class="officials-form">
                    <h1>ADD OFFICIALS AND STAFFS</h1>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
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
                            <label for="fullname">Full Name: </label><br>
                            <input id="fullname" name="fullname"><br>
                            <label for="age">Age: </label><br>
                            <input id="age" name="age"><br>
                            <label for="sex">Sex: </label><br>
                            <select name="sex" id="sex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select><br>
                            <label for="position">Position: </label><br>
                            <select id="position" name="position">
                                <option value="" disabled selected>Select Official Position</option>
                                <option value="Barangay Captain">Barangay Captain</option>
                                <option value="Barangay Kagawad">Barangay Kagawad (Councilor)</option>
                                <option value="Barangay Secretary">Barangay Secretary</option>
                                <option value="Barangay Treasurer">Barangay Treasurer</option>
                                <option value="Barangay Tanod">Barangay Tanod (Peace Officer)</option>
                                <option value="Barangay Clerk">Barangay Clerk</option>
                                <option value="Barangay Health Worker">Barangay Health Worker</option>
                                <option value="Barangay Sk Chairman">Barangay Sangguniang Kabataan (SK) Chairman
                                </option>
                                <option value="Barangay Sk Chairman">Barangay Sangguniang Kabataan (SK) Kagawad</option>
                            </select><br>
                            <label for="address">Address: </label><br>
                            <input id="address" name="address"><br>
                            <label for="startterm">Start of Term: </label><br>
                            <input id="startterm" name="startterm" type="date"><br>
                            <label for="endterm">End of Term: </label><br>
                            <input id="endterm" name="endterm" type="date"><br>
                            <div class="button">
                                <button type="submit" name="submit">Add</button>
                                <button onclick="closeView()">Close</button>
                            </div>
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

    .main-page .officials-form-sec1 {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100vh;
        position: fixed;
        z-index: 100;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.4s ease, visibility 0.4s ease;
    }

    .main-page .officials-form-sec1.show {
        visibility: visible;
        opacity: 1;
    }

    .main-page .officials-form-sec1 .officials-form {
        width: 50%;
        height: 75vh;
        background-color: whitesmoke;
        padding: 2rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        margin: auto;
        margin-top: 3rem;
    }

    .main-page .officials-form-sec1 .officials-form h1 {
        font-size: 20px;
        font-weight: 600;
        color: #535353;
    }

    .main-page .officials-form-sec1 .officials-form form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }



    .main-page .officials-form-sec1 .officials-form form .image {
        width: 45%;
        margin-top: 1rem;
    }

    .main-page .officials-form-sec1 .officials-form .avatar {
        width: 100%;
        height: 32vh;
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .main-page .officials-form-sec1 .officials-form .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;

    }

    .main-page .officials-form-sec1 .officials-form .info-data {
        width: 100%;
        height: 32vh;
        margin-bottom: 2.5rem;
        padding-left: 2rem;
        color: #535353;
        font-weight: 500;
    }

    .main-page .officials-form-sec1 .officials-form .info-data input {
        width: 98.5%;
        height: 3vh;
        padding: 5px;
        font-size: 17px;
        margin-top: 0.2rem;
        margin-bottom: 0.8rem;
        border: 1px solid #ACA6A6;
        color: #535353;
        border-radius: 3px;
    }

    .main-page .officials-form-sec1 .officials-form .info-data select {
        width: 101%;
        height: 5vh;
        padding: 5px;
        font-size: 17px;
        margin-top: 0.2rem;
        margin-bottom: 0.8rem;
        border: 1px solid #ACA6A6;
        color: #ACA6A6;
        border-radius: 3px;
    }

    .main-page .officials-form-sec1 .officials-form .info-data select option {
        color: black;
    }

    .main-page .officials-form-sec1 .officials-form .info-data .button {
        width: 101%;
        margin-top: 1rem;
        justify-content: right;
    }

    .main-page .officials-form-sec1 .officials-form .info-data .button button {
        width: 15%;
        height: 5vh;
        margin-left: 5px;
        border: 1px solid #ACA6A6;
        cursor: pointer;
        border-radius: 3px;
        transition: 0.2s;
        font-weight: 500;
        color: #3e3e3e;
        font-size: 17px;
    }

    .main-page .officials-form-sec1 .officials-form .info-data .button button:hover {
        transition: 0.2s;
        color: #fff;
        background-color: #626262;
    }

    .upload-btn {
        width: 83.2%;
        height: 2.5vh;
        text-align: center;
        align-items: center;
        cursor: pointer;
        display: inline-block;
        padding: 10px 20px;
        background-color: #949494;
        color: white;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        transition: 0.2s;
    }

    .upload-btn:hover {
        transition: 0.2s;
        background-color: #bababa;
    }

    input[type="file"] {
        display: none;
    }
</style>

<script>
    function editResident(officialData) {
        var data = officialData;
        var view = document.getElementById('updateForm');

        view.innerHTML = `
        <div class="officials-form">
            <h1>UPDATE OFFICIALS</h1><hr>
                <form action="update-officials.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="officialId" value="${data.id}">
                <div class="image">
                        <div class="avatar" id="avatar">
                            <img src="${data.profile_image}" alt="">
                        </div>
                        <label for="photo" class="upload-btn">Upload Photo</label><br>
                        <input type="file" id="photo" name="photo" accept="image/*"><br>
                    </div>
                    <div class="info-data">
                    <label for="fullname">Full Name: </label><br>
                    <input id="fullname" name="fullname" value="${data.full_name}"><br>
                    <label for="age">Age: </label><br>
                    <input id="age" name="age" value="${data.age}"><br>
                    <label for="sex">Sex: </label><br>
                    <select name="sex" id="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select><br>
                    <label for="position">Position: </label><br>
                    <select id="position" name="position">
                        <option value="" disabled selected>Select Official Position</option>
                        <option value="Barangay Captain">Barangay Captain</option>
                        <option value="Barangay Kagawad">Barangay Kagawad (Councilor)</option>
                        <option value="Barangay Secretary">Barangay Secretary</option>
                        <option value="Barangay Treasurer">Barangay Treasurer</option>
                        <option value="Barangay Tanod">Barangay Tanod (Peace Officer)</option>
                        <option value="Barangay Clerk">Barangay Clerk</option>
                        <option value="Barangay Health Worker">Barangay Health Worker</option>
                        <option value="Barangay Sk Chairman">Barangay Sangguniang Kabataan (SK) Chairman</option>
                        <option value="Barangay Sk Chairman">Barangay Sangguniang Kabataan (SK) Kagawad</option>
                    </select><br>
                    <label for="address">Address: </label><br>
                    <input id="address" name="address" value="${data.address}"><br>
                    <label for="startterm">Start of Term: </label><br>
                    <input id="startterm" name="startterm" type="date" value="${data.term_start}"><br>
                    <label for="endterm">End of Term: </label><br>
                    <input id="endterm" name="endterm" type="date" value="${data.term_end}"><br>
                    <div class="button">
                        <button type="submit" name="submit">Add</button>
                        <button class="closeView" onclick="closeView()">Close</button>
                    </div>
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


        view.classList.toggle('show');

        var button = document.getElementsByClassName("closeView")[0];
        button.onclick = function () {
            view.classList.remove('show');
        }
    }

    function deleteOfficial(officialData, id) {
        if (confirm('Are you sure you want to delete this resident?')) {
            window.location.href = `delete-officials.php?id=${id}`;
        }
    }


    document.addEventListener("DOMContentLoaded", function () {
        const loadingScreen = document.getElementById('loading-screen');
        const content = document.getElementById('content');

        // Adding a delay to ensure the loading screen stays visible for a brief moment
        setTimeout(() => {
            loadingScreen.style.display = 'none';
            content.style.display = 'flex';
        }, 1000); // Adjust the delay as necessary (1500 milliseconds in this example)
    });

    function addOfficial() {
        var add = document.getElementById('addOff');
        add.style.display = 'none';

        const officialForm = document.getElementById('officialForm');
        officialForm.style.display = 'block';
        officialForm.style.animation = 'slideDown1 0.3s ease-in-out forwards';
    }
</script>