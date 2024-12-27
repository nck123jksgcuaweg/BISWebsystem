<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>eBarangay</title>

        <!--stylesheet-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="stylee.css">
    </head>
    
    <body>
        <div class="background">
            <div class="background-logo">
                <div class="signup-form">
                    <div class="logo1">
                        <img src="images/logo.png" alt="">
                    </div>
                    <div class="signup">
                        <h1>Sign up</h1>

                        <form action="signup.php" method="post">
                        <?php
                        if (isset($_POST["submit"])) {
                            $lastName = $_POST["lastname"];
                            $firstName = $_POST["firstname"];
                            $username = $_POST["username"];
                            $contact = $_POST["contact"];
                            $password = $_POST["password"];
                            $confirmPassword = $_POST["confirm-password"];

                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                            $errors = array();

                            if (empty($lastName) and empty($firstName) and empty($username) and empty($password) and empty($confirmPassword)) {
                                array_push($errors, "All fields are required");
                            }
                            if (strlen($password) < 8) {
                                array_push($errors, "Password must be at least 8 charactes long");
                            }
                            if ($password !== $confirmPassword) {
                                array_push($errors, "Password does not match");
                            }

                            require_once "database.php";

                            $sql = "SELECT * FROM users WHERE username = '$username'";
                            $result = mysqli_query($conn, $sql);
                            $rowCount = mysqli_num_rows($result);

                            if ($rowCount > 0) {
                                array_push($errors, "Username already exists!");
                            }
                            if (count($errors) > 0) {
                                foreach ($errors as $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            } else {

                                $sql = "INSERT INTO users (firstName, lastName, username, contact, password) VALUES ( ?, ?, ?, ?, ? )";
                                $stmt = mysqli_stmt_init($conn);
                                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                                if ($prepareStmt) {
                                    mysqli_stmt_bind_param($stmt, "sssss", $lastName, $firstName, $username, $contact, $passwordHash);
                                    mysqli_stmt_execute($stmt);
                                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                                } else {
                                    die("Something went wrong");
                                }
                            }
                        }
                        ?>

                            <div class="name">
                                <label for="">Last Name</label>
                                <div class="space1"></div>
                                <label for="">First Name</label>
                            </div>
                            <div class="name">
                                <input type="text" name="firstname" id="first-name">
                                <div class="space"></div>
                                <input type="text" name="lastname">
                            </div>
                            <div class="name" style="margin-top: 1rem;">
                                <label for="">Username</label>
                                <div class="space1"></div>
                                <label for="" style="margin-left: 0.3rem;">Contact</label>
                            </div>
                            <div class="name">
                                <input type="text" name="username" id="username" style="margin-bottom: 13px;">
                                <div class="space"></div>
                                <input type="number" name="contact" id="contact" style="margin-bottom: 13px;">
                            </div>
                            
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" style="margin-bottom: 13px;">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm-password" id="" style="margin-bottom: 13px;">
                            <input id="button" type="submit" value="Sign up" name="submit">
                            <p>Already have an account? <a href="login.php">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>