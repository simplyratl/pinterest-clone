<?php

require('../conn.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

$id = $_SESSION['id'];

$userSQL = "SELECT * FROM users WHERE id=$id";
$userResult = $conn->query($userSQL);

$user = $userResult->fetch_assoc();

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
    <script src="https://kit.fontawesome.com/f5f8362cf6.js" crossorigin="anonymous"></script>
    <title>Pinterest</title>
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
                echo '<img src="data:image/jpeg;base64,' . base64_encode($user['image']) . '" class="avatar-picture" id="avatar-picture" onclick="openDropDownUser()"/>'
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

    <div class="posts-container" id="posts">

    </div>

    <div class="add-post" id="add-post" style="display: none">
        <div class="add-post-wrapper">
            <div class="top">
                <i class="fa-solid fa-xmark" onclick="closeModal()"></i>
            </div>

            <div class="feed">
                <div class="image">
                    <input type="file" name="image" accept="image/*" id="image" />
                    <input type="hidden" id="id" value="<?php echo $id; ?>">
                </div>

                <div class="info">
                    <input type="text" placeholder="Add your title" id="title">

                    <div class="user">
                        <?php
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($user['image']) . '" class="avatar-picture" />'
                        ?>

                        <p><?php echo $user['username']; ?></p>
                    </div>

                    <textarea id="description" placeholder="Type in description" class="description"></textarea>

                    <input id="hashtags" placeholder="Type in hashtags" class="hashtags">

                    <button id="submit-add">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../script/index.js"></script>
    <script src="../script/search.js"></script>
</body>

</html>