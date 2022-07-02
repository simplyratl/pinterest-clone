<?php

require('../conn.php');

if (isset($_SESSION['id'])) {
    header("Location: index.php");
}

$username = $password = '';
$submitError = '';
$valid = true;

if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $valid = false;
    }

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $valid = false;
    }

    $user = "SELECT * FROM users WHERE username='$username'";
    $resultUser = $conn->query($user);

    if ($resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();

        if (!password_verify($password, $rowUser['password'])) {
            $valid = false;
            $submitError = "Invalid password.";
        }

        if ($valid) {
            $_SESSION['id'] = $rowUser['id'];
            $conn->close();
            header('Location: index.php');
        }
    } else {
        $submitError = "User not found.";
    }
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
    <title>Login</title>
</head>

<body>

    <div class="registration-container">
        <img src="https://www.drupal.org/files/badgeRGB.png" />

        <h1>Login</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="row">
                <label>Username</label>
                <input type="text" placeholder="Username" name="username" autocomplete="off" id="username" value="<?php echo $username ?>">
            </div>

            <div class="row">
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" autocomplete="off" id="password">
            </div>

            <span id="error" style="color: red;"><?php echo $submitError; ?></span>

            <div class="row">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>

        <a href="./registration.php" style="font-size: 30px">Register</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>