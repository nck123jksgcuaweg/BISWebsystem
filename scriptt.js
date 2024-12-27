//logo
function logo() {
    window.location.href = 'index.php';
}

function logo1() {
    window.location.href = 'home.php';
}

function menu() {
    var menu = document.querySelector('.menu');
    var mainPage = document.getElementById('main-page');
    var isOpen = menu.classList.contains('open');
    var menuWidth = menu.offsetWidth;

    if (!isOpen) {
        menu.classList.add('open');
        menu.style.display = "block";
        menu.style.transform = 'translateX(0%)';

        mainPage.style.marginLeft = '0%'; // Adjust this value to match the width of the menu

        setTimeout(function () {
            menu.style.maxHeight = menu.scrollHeight + "px";
        }, 10); // Small delay for transition to work properly
    } else {
        menu.classList.remove('open');
        menu.style.maxHeight = null;
        mainPage.style.marginLeft = '0%'; // Set marginLeft to 0 when menu is closed

        setTimeout(function () {
            menu.style.display = "none";
        }, 0); // Delay to match the CSS transition duration
    }
}

function userProfile() {
    var profileDiv = document.getElementById("user");
    if (profileDiv.style.display === "none") {
        profileDiv.style.display = "block"; // Show profile
    } else {
        profileDiv.style.display = "none"; // Hide profile
    }
}

function toggleDropdown(element) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown !== element.nextElementSibling) {
            openDropdown.style.display = 'none';
        }
    }
    element.nextElementSibling.style.display = element.nextElementSibling.style.display === 'block' ? 'none' : 'block';
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches('.dropdown button')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }
}

function printDocs() {
        
    window.print();
}

function addOfficial() {
    const officialForm = document.getElementById('officialForm');
    const add = document.getElementById('addOff');

    officialForm.classList.toggle('show');
    add.style.display = 'none';
}

//view information for officials and staff
function viewOfficial(officialData) {
    var data = JSON.parse(officialData);
    var view = document.getElementById('viewInformation');
    view.innerHTML = `
            <div class="view-information1" id="officialView">                    
                <h1>PERSONAL INFORMATION</h1><hr>
                <div class="content">
                <form>
                    <div class="fillup-form">
                        <div class="user-image">
                            <img src="${data.profile_image}" alt="Photo of ${data.fName} ${data.lName}">
                        </div>
                        <div class="resident-information">
                                <h2>Basic Information</h2>
                                <div class="label">
                                    <p>Full Name</p>
                                    <div class="space"></div>
                                    <p>Position</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.full_name}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.position}</div>
                                </div>
                                <div class="label">
                                    <p>Age</p>
                                    <div class="space"></div>
                                    <p>Sex</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.age}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.sex}</div>
                                </div>
                                <div class="label">
                                    <p>Address</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.address}</div>
                                </div>
                                <div class="label">
                                    <p>Start of Term</p>
                                    <div class="space"></div>
                                    <p>End of Term</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.term_start}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.term_end}</div>
                                </div>    
                        </div>
                    </div>
                    <div class="space"></div>
                </form>
                </div>
                <div class="button1">
                    <button class="close">Close</button>
                </div>
            </div>
        `;

    view.classList.toggle('show');
    var button = document.getElementsByClassName("close")[0];
    button.onclick = function () {
        view.classList.remove('show'); // Hide the form without transition
    }
}

function generate() {
    indigency.style.display = 'flex';
}
// view information for residents
function view(residentData) {
    var data = JSON.parse(residentData);
    var view = document.getElementById('viewInformation');
    view.innerHTML = `
            <div class="view-information1">                    
                <h1>PERSONAL INFORMATION</h1><hr>
                <div class="content">
                <form>
                    <div class="fillup-form">
                        <div class="user-image">
                            <img src="${data.photo_path}" alt="Photo of ${data.fName} ${data.lName}">
                        </div>
                        <div class="resident-information">
                            <div class="form-information">
                                <h2>Basic Information</h2>
                                <div class="label">
                                    <p>First Name</p>
                                    <div class="space"></div>
                                    <p>Middle Name</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.fName}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.mName}</div>
                                </div>
                                <div class="label">
                                    <p>Last Name</p>
                                    <div class="space"></div>
                                    <p>Suffix Name</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.lName}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.sName}</div>
                                </div>
                                <div class="label">
                                    <p>Age</p>
                                    <div class="space"></div>
                                    <p>Sex</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.age}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.sex}</div>
                                </div>
                                <div class="label">
                                    <p>Birthdate</p>
                                    <div class="space"></div>
                                    <p>Birthplace</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.birthmonth + " " + data.birthday + " " + data.birthyear}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.birthplace}</div>
                                </div>
                                <div class="label">
                                    <p>Occupation</p>
                                    <div class="space"></div>
                                    <p>Citizenship</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.occupation}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.citizenship}</div>
                                </div>
                                <p>National Identification Number</p>
                                <div class="info">${data.national_ID}</div>
                                <h2 style="padding-top: 1.5rem;">Other Information</h2>
                                <div class="label">
                                    <p>Contact No.</p>
                                    <div class="space"></div>
                                    <p>Email</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.contact}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.email}</div>
                                </div>
                                <p>Address<p>
                                <div class="label">
                                    <p>House No./Street/Zone</p>
                                    <div class="space"></div>
                                    <p>Purok</p>
                                    <div class="space"></div>
                                    <p>Barangay</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.houseNum}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.purok}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.barangay}</div>
                                </div>
                                <div class="label">
                                    <p>Municipality</p>
                                    <div class="space"></div>
                                    <p>Province</p>
                                </div>
                                <div class="info-area">
                                    <div class="info">${data.municipality}</div>
                                    <div class="space"></div>
                                    <div class="info">${data.province}</div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="space"></div>
                </form>
                </div>
                <div class="button">
                    <button class="close">Close</button>
                </div>
            </div>
        `;

        view.classList.toggle('show');
    var button = document.getElementsByClassName("close")[0];
    button.onclick = function () {
        view.classList.remove('show');
    }
}


function closeView() {
    const view = document.getElementById('officialForm');
    const add = document.getElementById('addOff');

    view.classList.remove('show');
    add.style.display = 'flex';
}

// Select the search input field
const searchInput = document.getElementById('searchInput');

// Add event listener for keypress event
searchInput.addEventListener('keypress', function (event) {
    // Check if the pressed key is the "Enter" key (key code 13)
    if (event.key === 'Enter') {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Trigger the form submission
        document.getElementById('searchForm').submit();
    }
});

function generate() {
    var generateFile = document.getElementById('barangay-clearance');

    if (generateFile.style.display === 'none' || generateFile.style.display === '') {
        generateFile.style.display = 'block';
        generateBtn.style.display = 'none';
        printBtn.style.display = 'block';
    }
    else {
        generateFile.style.display = 'none';
    }
}



function editProfile() {
    window.location.href = 'edituser.php';
}

function changeUsername() {
    window.location.href = 'change-username.php';
}

function changePass() {
    window.location.href = 'change-password.php';
}



document.body.style.transform = "scale(0.8)";
document.body.style.transformOrigin = "0 0";
document.body.style.width = "125%"; // Adjust for scaling