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
            <div id="loading-screen">
                <div class="loading-line"></div>
            </div>
            <div class="announcement-area" id="content">
                <div class="dashboard-area">
                    <div class="dashboard-box" id="dashboard-box">
                        <div class="announcement">
                            <div class="announcement-list">

                                <?php
                                require_once "database.php";

                                // Check if form is submitted by admin
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_announcement'])) {
                                    // Get announcement text from form
                                    $what = $_POST['what'];
                                    $who = $_POST['who'];
                                    $where = $_POST['where'];
                                    $when = $_POST['when'];
                                    $why = $_POST['why'];

                                    // Prepare and bind the statement
                                    $stmt = $conn->prepare("INSERT INTO announcements (whatt, whoo, wheree, whenn, whyy) VALUES (?, ?, ?, ?, ?)");
                                    $stmt->bind_param("sssss", $what, $who, $where, $when, $why);

                                    // Execute the statement
                                    if ($stmt->execute()) {
                                        echo "Announcement added successfully.";
                                    } else {
                                        echo "Error: " . $stmt->error;
                                    }

                                    // Close statement
                                    $stmt->close();
                                }

                                // Retrieve announcements from database
                                $sql = "SELECT id, whatt, whoo, whenn, wheree, whyy FROM announcements ORDER BY id DESC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $what = $row["whatt"];
                                        $who = $row["whoo"];
                                        $why = $row["whyy"];
                                        $where = $row["wheree"];
                                        $when = $row["whenn"];
                                        $id = $row["id"];

                                        $announcementData = json_encode($row); // Encode the data to JSON format
                                        $announcementData = htmlspecialchars($announcementData, ENT_QUOTES, 'UTF-8');

                                        // Output a separate <div> for each announcement
                                        echo '<div class="announcement1" id="content1">';
                                        echo '<div class="buttonSelect">
                                                    <button onclick="editAnnouncement(' . $announcementData . ')">EDIT</button>
                                                    <form action="delete-announcement.php" method="post">
                                                    <input type="hidden" name="announcement_id" value="' . $id . '">
                                                    <button type="submit" name="delete_announcement">DELETE</button>
                                                    </form>
                                                    </div>';
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
            <div class="announcement-form" id="announcementForm">
                <div class="announcement-form-area">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
                        <h2 for="">Add Announcement:</h2>
                        <hr style="margin-bottom: 1rem;">
                        <label for="what">What: </label><br>
                        <input id="what" name="what"><br>
                        <label for="who">Who: </label><br>
                        <input id="who" name="who"><br>
                        <label for="when">When: </label><br>
                        <input id="when" name="when"><br>
                        <label for="where">Where: </label><br>
                        <input id="where" name="where"><br>
                        <label for="why">Purpose: </label><br>
                        <input id="why" name="why"><br>
                        <div class="button">
                            <button type="submit" name="submit_announcement">Add</button>
                            <button onclick="closeAnnouncement()">Close</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="announcement-form" id="updateAnnouncement"></div>
            <div class="add" onclick="addAnnouncement()">
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
    /* admin */
    .announcement1 .buttonSelect {
        width: 96%;
        display: flex;
        align-items: center;
        justify-content: right;
    }

    .announcement1 .buttonSelect button {
        font-size: 19px;
        background-color: #40785a;
        color: #ACA6A6;
        border: none;
        border-bottom: 1px solid #306146;
        margin-left: 1rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .announcement1 .buttonSelect button:hover {
        color: white;
        border-bottom: 1px solid #fff;
        transition: 0.2s;
    }

    .announcement-form {
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
        transition: opacity 0.4s ease-in, visibility 0.4s ease-in;
    }

    .announcement-form.show {
        visibility: visible;
        opacity: 1;
    }

    .main-page .announcement-form h2 {
        font-size: 20px;
        font-weight: 600;
        color: #535353;
    }

    .announcement-form-area {
        width: 50%;
        height: auto;
        background-color: whitesmoke;
        padding: 2rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        margin: auto;
        margin-top: 5rem;
    }

    .announcement-form-area .btnAnn {
        width: 97.6%;
        height: 5.5vh;
        background-color: #dddddd;
        cursor: pointer;
    }

    .announcement-form-area label {
        color: #535353;
        font-weight: 100;
    }


    .announcement-form-area input {
        width: 98.7%;
        height: 4vh;
        font-size: 15px;
        padding: 5px;
        margin: 0rem;
        font-size: 17px;
        border: 1px solid #ACA6A6;
        color: #535353;
        border-radius: 3px;
        margin-top: 0.3rem;
        margin-bottom: 1rem;
    }

    .announcement-form-area label {
        font-size: 17px;
        font-weight: 600;
    }

    .main-page .announcement-form .button {
        display: flex;
        align-items: center;
        justify-content: end;
    }

    .main-page .announcement-form .button button {
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

    .main-page .announcement-form .button button:hover {
        transition: 0.2s;
        color: #fff;
        background-color: #626262;
    }



    /* announcement */
    .dashboard-box .announcement {
        width: 90%;
        height: 60vh;
        background-color: #71B4E5;
        padding-top: 7rem;
        padding-left: 0.7rem;
        padding-right: 0.7rem;
        padding-bottom: 2.7rem;
        margin: 2rem;
        border-radius: 10.5px;
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
        background-color: #467DA4;
        margin-top: 0.7rem;
        line-height: 0rem;
        padding-top: 2rem;
        padding-bottom: 2rem;
        border-radius: 10px;
        border: none;
        text-align: left;
        display: flex;
        flex-direction: column;
    }

    .announcement .announcement-list {
        overflow-y: scroll;
        scrollbar-color: #71B4E5 #467DA4;
        width: 97%;
        margin-left: 2rem;

    }

    .dashboard-box .announcement::before {
        content: 'ANNOUNCEMENTS';
        width: 95.5%;
        height: 3vh;
        background-color: #467DA4;
        text-align: left;
        position: absolute;
        top: 0;
        border-radius: 10px;
        padding: 2rem;
        font-size: 25px;
        font-weight: 700;
        box-shadow: 0 2px 2px 0 black;
    }

    .dashboard-box .announcement1 h2 {
        padding: 10rem;
        text-align: center;
        font-size: 25px;
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
        font-size: 23px;
        font-weight: 700;
        box-shadow: 0 2px 2px 0 black;
    }

    .dashboard-box .announcement1 h2 {
        padding: 10rem;
        text-align: center;
        font-size: 25px;
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
    function editAnnouncement(announcementData) {
        var data = announcementData;
        var view = document.getElementById('updateAnnouncement');

        view.innerHTML = `
        <div class="announcement-form-area">
                    <form action="update-announcement.php" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="announcementId" value="${data.id}">
                        <h2 for="">Edit Announcement:</h2><hr style="margin-bottom: 1rem;">
                        <label for="what">What: </label><br>
                        <input id="what" name="what" value="${data.whatt}"><br>
                        <label for="who">Who: </label><br>
                        <input id="who" name="who" value="${data.whoo}"><br>
                        <label for="when">When: </label><br>
                        <input id="when" name="when" value="${data.whenn}"><br>
                        <label for="where">Where: </label><br>
                        <input id="where" name="where" value="${data.wheree}"><br>
                        <label for="why">Purpose: </label><br>
                        <input id="why" name="why" value="${data.whyy}"><br>
                        <div class="button">
                            <button type="submit" name="submit_announcement">Save</button>
                            <button onclick="closeAnnouncement()">Close</button>
                        </div>
                    </form>
                </div>
        `;

        view.classList.toggle('show');

        var button = document.getElementsByClassName("closeView")[0];
        button.onclick = function () {
            view.classList.remove('show');
        }
    }



    function addAnnouncement() {
        const officialForm = document.getElementById('announcementForm');
        officialForm.classList.toggle('show');
        officialForm.style.animation = 'slideDown1 0.3s ease-in-out forwards';
    }

    function closeAnnouncement() {
        const officialForm = document.getElementById('announcementForm');
        officialForm.classList.remove('show');
        officialForm.style.animation = 'slideDown1 0.3s ease-in-out forwards';
    }

    // Add this to your existing script.js
    document.addEventListener("DOMContentLoaded", function () {
        const loadingScreen = document.getElementById('loading-screen');
        const content = document.getElementById('content');

        // Adding a delay to ensure the loading screen stays visible for a brief moment
        setTimeout(() => {
            loadingScreen.style.display = 'none';
            content.style.display = 'block';
        }, 400);
    });

</script>