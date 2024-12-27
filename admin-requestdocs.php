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
    <link rel="stylesheet" href="requesttt.css">

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
          
        <div class="main-page1" id="main-page">
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
                <h2>Request for Barangay Documents</h2>
                <div class="dashboard-box" id="dashboard-box">
                    <div class="request-records">
                        <img src="images/file.png" alt="">
                        <div class="space"></div>
                        <div class="label">
                            <h4> TOTAL REQUEST</h4>
                            <div class="totalResident" style="font-size: 95px; text-align: center; font-weight: 700;">
                                <?php require_once "database.php";
                                echo isset($totalRequest) ? $totalRequest : '0'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="request-list">
                   
                        <form action="admin-requestdocs.php" method="get">
                            <input type="text" name="query" placeholder="Enter name">
                            <button type="submit" class="searchBtn">Search</button>
                        </form>
                        <div class="request-info-label">
                            <div class="request-name-label">Name</div>
                            <div class="request-gender-label">Document</div>
                            <div class="request-age-label">Purpose</div>
                            <div class="request-contact-label">Transaction ID</div>
                            <div class="request-action-label">Action</div>
                        </div>
                        <div id="request-container">
                            <!-- Request details will be inserted here -->
                        </div>

                        <div class="navigation">
                            <button id="prev" onclick="navigateRequests(-1)" disabled>Prev</button>
                            <button id="next" onclick="navigateRequests(1)">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="generate-request" id="generateRequest">
                <!-- Generate request code will be dynamically inserted here -->
            </div>
            <div class="space-bottom"></div>
        </div>
    </div>
    <div class="footer">
        <footer>eBARANGAY &copy 2024 </footer>
    </div>

    <style>
        #clearance-title h2 {
            font-size: 21px;
            color: black;
            text-decoration: underline;
            text-decoration-color: rgb(26, 90, 218);
        }

        #clearance {
            margin-top: 1rem;
            width: 100%;
        }

        #clearance1 {
            margin-left: -2.4rem;
        }

        #clearance .line {
            margin-top: 1.5rem;
            margin-left: 1rem;
        }

        #clearance #applicantSign {
            margin-top: -3rem;
            margin-left: 2rem;
            font-size: 15px;
        }

        #clearance .thumbmark {
            margin-top: -3rem;
            margin-left: 1rem;
            font-size: 15px;
            text-decoration: underline;
        }

        #clearance .thumbmarkArea {
            display: flex;
            margin-top: 3rem;
            margin-left: 1rem;
        }

        #clearance button {
            width: 6rem;
            height: 18.5vh;
            background-color: #fff;
            border-radius: 0px;
            border: 1px solid;
            margin-left: 0rem;
            margin-bottom: 0.5rem;
            font-style: italic;
            padding-top: 8rem;
        }

        .signature-area #captain {
            margin-top: 1rem;
        }
    </style>

    <script>
        let requests = [];
        let currentIndex = 0;
        const itemsPerPage = 4;

        <?php
        require_once "database.php";
        $sql = "SELECT * FROM `request_documents`";
        $result = $conn->query($sql);
        $requests = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $requests[] = $row;
            }
        }

        echo "requests = " . json_encode($requests) . ";";
        ?>

        function navigateRequests(step) {
            currentIndex += step * itemsPerPage;
            displayRequests(currentIndex);
        }

        function displayRequests(index) {
            const requestContainer = document.getElementById('request-container');
            requestContainer.innerHTML = ''; // Clear previous content

            const end = index + itemsPerPage;
            const displayItems = requests.slice(index, end);

            displayItems.forEach(request => {
                if (request.status === 'Paid') {
                    return;
                }

                const upperCaseName = `${request.fname} ${request.mname} ${request.lname} ${request.sname}`.toUpperCase();
                const requestDiv = document.createElement('div');
                requestDiv.className = 'request-info';
                requestDiv.innerHTML = `
                    <div class="request-name">${request.fname} ${request.mname} ${request.lname} ${request.sname}</div>
                    <div class="request-gender">${request.documentType}</div>
                    <div class="request-age">${request.purpose}</div>
                    <div class="request-contact">${request.transaction_id}</div>
                    <button class="accept" onclick="accept('${upperCaseName}', '${getDateWithOrdinal(new Date())}', '${request.status}', '${request.age}', '${request.documentType}')"></button>
                    <form action="delete-request.php" method="get" onsubmit="return confirm('Are you sure you want to delete this request?');">
                        <div class="space"></div>
                        <input type="hidden" name="transaction_id" value="${request.transaction_id}">
                        <button type="submit" class="reject" onclick="rejectRequest"></button>
                    </form>
                `;
                requestContainer.appendChild(requestDiv);
            });

            document.getElementById('prev').disabled = index <= 0;
            document.getElementById('next').disabled = end >= requests.length;
        }

        if (requests.length > 0) {
            displayRequests(currentIndex);
        }

        function getDateWithOrdinal(date) {
            const day = date.getDate();
            const month = date.toLocaleString('default', { month: 'long' });
            const year = date.getFullYear();

            let ordinal;

            if (day > 3 && day < 21) {
                ordinal = 'th';
            } else {
                switch (day % 10) {
                    case 1:
                        ordinal = 'st';
                        break;
                    case 2:
                        ordinal = 'nd';
                        break;
                    case 3:
                        ordinal = 'rd';
                        break;
                    default:
                        ordinal = 'th';
                }
            }

            return `${day}${ordinal} of ${month}, ${year}`;
        }

        function accept(uppercaseName, dateWithOrdinal, status, age, documentType) {
            var generate = document.getElementById('generateRequest');

            function underlineStatus(currentStatus) {
                return currentStatus === status ? `<u>${currentStatus}</u>` : currentStatus;
            }

            if (documentType === 'Clearance') {
                generate.innerHTML = `
                <div class="generate-file">
                    <div class="certificate">
                        <div class="cert-sec">
                            <header>VIEW</header>
                            <div class="generateBtn" id="generateBtn">
                                <button onclick="generate()">GENERATE FILE</button>
                            </div>
                            <div class="certificate-file" id="barangay-clearance" role="document">
                                <div class="cert-header" id="clearance-header">
                                    <img src="images/logo.png" alt="">
                                    <div class="space"></div>
                                    <h1>Republic of the Philippines <br>
                                        Province of Northern Samar <br>
                                        Municipality of Lavezares <br>
                                        BARANGAY LIBAS
                                    </h1>
                                </div>
                                <div class="cert-content" id="clearance-title">
                                    <h2>BARANGAY CLEARANCE</h2>
                                </div>
                                <div class="cert-info-sec" id="clearance">
                                    <h3>To Whom It May Concern</h3>
                                    <div class="cert-info" id="clearance1">
                                        <p>This is to certify that <b><u>${uppercaseName}</u></b>., of legal
                                            age,
                                            ${underlineStatus('single')}/${underlineStatus('married')}/${underlineStatus('unmarried')}/${underlineStatus('widow')}, Filipino and a bonafide resident of Barangay Libas,
                                            Lavezares Northern Samar, is known to me of good moral standing and has no derogatory records nor any pending case filed against him/her in this Barangay.
                                        </p>
                                        <p>This clearance is issued upon request of the interested party, this ${dateWithOrdinal} at Barangay Libas, Lavezares Northern Samar, for whatever legal purposes it may serve.</p>
                                    </div>
                                    <p class="line">_______________________</p>
                                    <p id="applicantSign">Signature of applicant</p>
                                    <div class="thumbmarkArea">
                                    <button>LEFT</button><button>RIGHT</button>
                                    </div>
                                    <p class="thumbmark">THUMBMARK</p>
                                    <div class="signature-area">
                                        <div class="signature" id="captain">
                                            <h1 style="text-decoration: underline;">MA. DELILAH A. CAMPOSANO</h1>
                                            <h1 style="font-weight: 300; font-size: 15px;">Punong Barangay</h1>
                                        </div>
                                    </div>
                                    <div class="footer" style="margin-top: -8rem;">NOT VALID WITHOUT OFFICIAL BARANGAY SEAL</div>
                                </div>
                            </div>
                            <div class="printBtn" id="printBtn">
                                <button onclick="printDocs()" aria-controls="barangay-clearance">Print</button>
                                <button onclick="closeFile()" aria-controls="barangay-clearance">Close</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            }

            if (documentType === 'Residency') {
                generate.innerHTML = `
                <div class="generate-file">
                    <div class="certificate">
                        <div class="cert-sec">
                            <header>VIEW</header>
                            <div class="generateBtn" id="generateBtn">
                                <button onclick="generate()">GENERATE FILE</button>
                            </div>
                            <div class="certificate-file" id="barangay-clearance" role="document">
                                <div class="cert-header">
                                    <img src="images/logo.png" alt="">
                                    <div class="space"></div>
                                    <h1>Republic of the Philippines <br>
                                        Province of Northern Samar <br>
                                        Municipality of Lavezares <br>
                                        BARANGAY LIBAS
                                    </h1>
                                </div>
                                <div class="cert-content">
                                    <h1>OFFICE OF THE PUNONG BARANGAY</h1>
                                    <p>________________________________________________________________________</p>
                                    <h2>CERTIFICATION OF RESIDENCY</h2>
                                </div>
                                <div class="cert-info-sec">
                                    <h3>To Whom It May Concern</h3>
                                    <div class="cert-info">
                                        <p>This is to certify that <b><u>${uppercaseName}</u></b>., of ${age} years of legal
                                            age,
                                            ${underlineStatus('single')}/${underlineStatus('married')}/${underlineStatus('unmarried')}/${underlineStatus('widow')}, Filipino, is currently residing at Barangay Libas,
                                            Lavezares Northern Samar.
                                        </p>
                                        <p>This further certifies that the above-named is a registered member of the barangay per RBI (Registration of Barangay Inhabitants) record.</p>
                                        <p>This certification is issued upon request of the interested party, this ${dateWithOrdinal},
                                            at Barangay Libas, Lavezares Northern Samar for whatever legal purposes it may serve.</p>
                                    </div>
                                    <h4>Certified by:</h4>
                                    <div class="signature-area">
                                        <div class="signature">
                                            <h1 style="text-decoration: underline;">MA. DELILAH A. CAMPOSANO</h1>
                                            <h1>Punong Barangay</h1>
                                        </div>
                                    </div>
                                    <div class="footer">NOT VALID WITHOUT OFFICIAL BARANGAY SEAL</div>
                                </div>
                            </div>
                            <div class="printBtn" id="printBtn">
                                <button onclick="printDocs()" aria-controls="barangay-clearance">Print</button>
                                <button onclick="closeFile()" aria-controls="barangay-clearance">Close</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            }

            if (documentType === 'Indigency') {
                generate.innerHTML = `
                <div class="generate-file">
                    <div class="certificate">
                        <div class="cert-sec">
                            <header>VIEW</header>
                            <div class="generateBtn" id="generateBtn">
                                <button onclick="generate()">GENERATE FILE</button>
                            </div>
                            <div class="certificate-file" id="barangay-clearance" role="document">
                                <div class="cert-header">
                                    <img src="images/logo.png" alt="">
                                    <div class="space"></div>
                                    <h1>Republic of the Philippines <br>
                                        Province of Northern Samar <br>
                                        Municipality of Lavezares <br>
                                        BARANGAY LIBAS
                                    </h1>
                                </div>
                                <div class="cert-content">
                                    <h1>OFFICE OF THE PUNONG BARANGAY</h1>
                                    <p>________________________________________________________________________</p>
                                    <h2>CERTIFICATE OF INDIGENCY</h2>
                                </div>
                                <div class="cert-info-sec">
                                    <h3>To Whom It May Concern</h3>
                                    <div class="cert-info">
                                        <p>This is to certify that <b><u>${uppercaseName}</u></b>., of legal
                                            age,
                                            ${underlineStatus('single')}/${underlineStatus('married')}/${underlineStatus('unmarried')}/${underlineStatus('widow')}, and a bonafide resident of Barangay Libas,
                                            Lavezares Northern Samar, and also an indigent member of our community.
                                        </p>
                                        <p>Their family income is below the poverty threshold as surveyed by the <b>National
                                                Housing Targeting System.</b></p>
                                        <p>Issued this ${dateWithOrdinal} upon the request of interested party,
                                            at Barangay Libas, Lavezares Northern Samar.</p>
                                    </div>
                                    <h4>Certified by:</h4>
                                    <div class="signature-area">
                                        <div class="signature">
                                            <h1 style="text-decoration: underline;">MA. DELILAH A. CAMPOSANO</h1>
                                            <h1>Punong Barangay</h1>
                                        </div>
                                    </div>
                                    <div class="footer">NOT VALID WITHOUT OFFICIAL BARANGAY SEAL</div>
                                </div>
                            </div>
                            <div class="printBtn" id="printBtn">
                                <button onclick="printDocs()" aria-controls="barangay-clearance">Print</button>
                                <button onclick="closeFile()" aria-controls="barangay-clearance">Close</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            }

            generate.classList.toggle('show');
        }

        function printDocs() {
            window.print();
        }

        function closeFile() {
                var generate = document.getElementById('generateRequest');
                generate.classList.remove('show');
            }
        
        // Add this to your existing script.js
        document.addEventListener("DOMContentLoaded", function() {
    const loadingScreen = document.getElementById('loading-screen');
    const content = document.getElementById('request-container');
    
    // Adding a delay to ensure the loading screen stays visible for a brief moment
    setTimeout(() => {
        loadingScreen.style.display = 'none';
        content.style.display = 'flex';
    }, 1000); // Adjust the delay as necessary (1500 milliseconds in this example)
});
        </script>
</body>
    
</html>