<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

require_once "database.php";  // Make sure this file correctly establishes your database connection

$userErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username)) {
        $userErr = "<div class='alert alert-danger'>Please enter username.</div>";
    }

    if (empty($password)) {
        $passwordErr = "<div class='alert alert-danger'>Please enter your password.</div>";
    }

    if (empty($userErr) && empty($passwordErr)) {
        $sql = "SELECT * FROM admin WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if ($result) {
                    $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if ($admin && $admin["password"] === $password) {
                        $_SESSION["admin"] = "yes";
                        header("Location: index.php");
                        exit();
                    } else {
                        $passwordErr = "<div class='alert alert-danger'>Invalid username or password.</div>";
                    }
                } else {
                    $userErr = "<div class='alert alert-danger'>No account found with that username.</div>";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="background">
        <div class="background-logo">
            <div class="login-form">
                <div class="login">
                    <div class="login-admin">
                    <img src="images/logo.png" alt="">
                    </div>

                    <div class="login-header">
                        <h1>Welcome</h1>
                        <p style="margin-top: unset;">Login as admin</p>
                    </div>

                    <form action="login-admin.php" method="post">
                        <span><?php echo $userErr; ?></span>
                        <span><?php echo $passwordErr; ?></span>
                        <label for="username">Username</label><br>
                        <input type="text" name="username" id="username" placeholder="Enter your username"
                            style="margin-bottom: 13px;"><br>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                        <input id="button" type="submit" value="LOGIN">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
/* logo area */
.login-admin {
    display: flex;
    align-items: center;
    justify-content: center;
}
.login-admin img {
    width: 17%;
    opacity: 55%;
    border-radius: 50%;
    z-index: -10;
}

/* login form */
.login-form {
    width: 40%;
    height: auto;
    margin: 5rem;
    background-color: #fff;
    z-index: 1000;
}

.login {
    width: 100%;
    height: auto;
    z-index: 1000;
    border-radius: 15px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: start;
    margin: 5rem;
}

.login-header {
    padding: 15px;
}

.login h1 {
    text-align: center;
    font-size: 50px;
    font-weight: 500;
}

.login label {
    font-size: 16px;
    font-weight: 400;
}

.login #button {
    width: 100%;
    height: 3.5rem;
    border-radius: 5px;
    border: 1px solid;
    cursor: pointer;
    background-color: #56CC2E;
    color: #fff;
    font-size: 25px;
    margin-top: 1.3rem;
}

.login #button:hover {
    transition: 0.2s;
    background: #40a120;
    border: none;
}

.login input {
    width: 100%;
    height: 60px;
    padding: 5px;
    font-size: 17px;
    border-radius: 5px;
    border: 1px solid #ACA6A6;
    margin-top: 5px;
}

.login input::placeholder {
    font-style: italic;
    font-weight: 100;
    color: #ACA6A6;
}

.login p {
    text-align: center;
    margin-top: 2rem;
}

.login a {
    font-weight: 500;
    color: #56CC2E;
    text-decoration: none;
}

.login #checkbox {
    width: unset;
    cursor: pointer;
}

</style>