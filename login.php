<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBarangay</title>

    <!--stylesheet-->
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="background">
        <div class="background-logo">
            <div class="login-form">
                <div class="login">
                    <div class="login-header">
                        <h1>Welcome</h1>
                        <p style="margin-top: unset;">Please enter your details</p>
                    </div>

                    <?php
                    require_once "database.php";

                    $userErr = $passwordErr = "";

                    if (isset($_POST["login"])) {
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        
                        $sql = "SELECT * FROM users WHERE username = '$username'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        if ($user) {
                            if (password_verify($password, $user["password"])) {
                                session_start();
                                $_SESSION["user"] = "yes";
                                header("Location: home.php");
                                die();
                            } else {
                                $passwordErr = "<div class='alert alert-danger'>Password does not match</div>";
                            }
                        } else {
                            $userErr = "<div class='alert alert-danger'>Username does not match</div>";
                        }
                    }
                    ?>

                    <form action="login.php" method="post">
                        <span><?php echo $userErr; ?></span>
                        <span><?php echo $passwordErr; ?></span>
                        <label for="Username">Username</label><br>
                        <input type="username" name="username" id="username" placeholder="Enter your username"
                            style="margin-bottom: 13px;"><br>
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                        <input id="button" type="submit" value="LOGIN" name="login">
                        <p>Don't have an account yet? <a href="signup.php">Sign up</a></p>
                    </form>
                </div>
                <div class="logo">
                    <img src="images/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>