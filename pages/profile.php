<?php

require('../conn.php');

if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header("Location: login.php");
}

$id = $_SESSION['id'];

$userSQL = "SELECT * FROM users WHERE id=$id";
$userResult = $conn->query($userSQL);

$user = $userResult->fetch_assoc();

$userProfile = "SELECT * FROM users WHERE id=" . $_GET['id'];
$userResult = $conn->query($userProfile);

$userProfile = $userResult->fetch_assoc();

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dist/index.css" />
    <link rel="stylesheet" href="../style/boilerplate.css" />
    <link rel="stylesheet" href="../style/dist/profile.css" />
    <script src="https://kit.fontawesome.com/f5f8362cf6.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="navbar">
        <div class="navbar-wrapper">
            <a href="./index.php">
                <img src="https://www.drupal.org/files/badgeRGB.png" class="logo" />
            </a>

            <input type="text" placeholder="Search" id="search" autocomplete="off">

            <i class="fa-solid fa-plus" style="font-size: 2.4rem; margin-right: 14px; cursor: pointer;" onclick="openAddModal()"></i>

            <div class="avatar">
                <?php
                echo '<img src="data:image/jpeg;base64,' . base64_encode($user['image']) . '" class="avatar-picture" onclick="openDropDownUser()"/>'
                ?>

                <div class="dropdown" id="dropdownUser">
                    <ul>
                        <a href="./profile.php?id=<?php echo $user['id'] ?>">Profile</a>
                        <a href="./logout.php">Logout</a>
                    </ul>
                </div>
            </div>

            <div class="suggestions" id="suggestions" style="display: none;">
                <ul id="search-results">

                </ul>
            </div>
        </div>
    </div>

    <div class="profile">
        <div class="top" id="top-profile">
            <?php
            echo '<img src="data:image/jpeg;base64,' . base64_encode($userProfile['image']) . '" class="avatar-picture" />'
            ?>

            <p class="username"><?php echo $userProfile['username'] ?></p>
            <p class="email"><?php echo $userProfile['email'] ?></p>

            <?php
            if ($_SESSION['id'] == $userProfile['id'] || $_SESSION['id'] == 23) {
                echo "<button class='button' onclick='toggleEdit()'>Edit Profile</button>";
            }
            ?>

        </div>
        <div class="bottom">
            <div class="top-pictures">
                <div id="created" style="color: red;">Created</div>
                <?php
                if ($_SESSION['id'] == $userProfile['id'] || $_SESSION['id'] == 23) {
                    echo "<div id='saved'>Saved</div>";
                }
                ?>
            </div>

            <div class="pictures" id="pictures">

            </div>
        </div>
    </div>

    <div class="edit-container" id="edit-container">
        <div class="edit">
            <h4>Edit</h4>
            <p id="remove" onclick="toggleEdit()">X</p>


            <div class="container">
                <div class="row">
                    <label>Username</label>
                    <input type="text" placeholder="Username" id="username" value="<?php echo $userProfile['username'] ?>">
                </div>
                <div class="row">
                    <label>Email</label>
                    <textarea type="email" placeholder="Email" id="email"><?php echo $userProfile['email'] ?></textarea>
                </div>

                <div class="row">
                    <button type="button delete-btn" id="delete-user">Delete</button>
                </div>

                <div class="row">
                    <button type="button" id="update-user">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var userID = <?php echo $userProfile['id'] ?>;
    </script>
    <script src="../script/index.js"></script>
    <script src="../script/search.js"></script>
    <script src="../script/single.js"></script>
    <script src="../script/profile.js"></script>
</body>

</html>