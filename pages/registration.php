<?php

require('../conn.php');

if (isset($_SESSION['id'])) {
    header("Location: index.php");
}

$username = $password = $email = $image = "";
$submitError = "";
$valid = true;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $checkAdded = "SELECT * FROM users WHERE username='$username' OR email = '$email';";

    $resultCheck = $conn->query($checkAdded);

    if ($resultCheck->num_rows > 0) {
        $valid = false;
        $submitError = 'User with this email or username already exists.';
    }

    if ($valid) {
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $image = file_get_contents($_FILES['image']['tmp_name']);
        $sql = $conn->prepare("INSERT INTO users(username, email, password, image) VALUES(?, ?, ?, ?);");
        $sql->bind_param("ssss", $username, $email, $hashedPassword, $image);

        if ($sql->execute()) {
            header("Location: login.php");
        } else {
            $submitError = 'Image has not been uploaded. Failed Registration.';
        }
    }


    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dist/registration.css" />
    <link rel="stylesheet" href="../style/boilerplate.css" />
    <title>Registration</title>
</head>

<body>

    <div class="registration-container">
        <img src="https://www.drupal.org/files/badgeRGB.png" />

        <h1>Registration</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <label>Username</label>
                <input type="text" placeholder="Username" name="username" autocomplete="off" id="username">
                <span id="errorUsername"></span>
            </div>

            <div class="row">
                <label>Email</label>
                <input type="email" placeholder="Email" name="email" autocomplete="off" id="email">
                <span id="errorEmail"></span>
            </div>

            <div class="row">
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" autocomplete="off" id="password">
                <span id="errorPassword"></span>
            </div>

            <div class="row">
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm password" name="confirm_password" autocomplete="off" id="password_confirm">
                <span id="errorPasswordConfirm"></span>
            </div>

            <div class="row">
                <input type="file" name="image" type="image/*" id="image" />
            </div>

            <div class="row">
                <button type="submit" name="submit" disabled id="submit">Register</button>
            </div>

            <div class="row">
                <span><?php echo $submitError; ?></span>
            </div>
        </form>

        <a href="./login.php" style="font-size: 30px;">Login</a>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../script/registration.js"></script>
</body>

</html>