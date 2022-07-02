<?php

require('../conn.php');

$id = $_SESSION['id'];
$postID = $_GET['id'];

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

$userSQL = "SELECT * FROM users WHERE id=$id";
$userResult = $conn->query($userSQL);

$user = $userResult->fetch_assoc();

$postSQL = "SELECT * FROM posts WHERE id=$postID";
$resultPost = $conn->query($postSQL);
$post = $resultPost->fetch_assoc();

if ($resultPost->num_rows == 0) {
    header("Location: index.php");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dist/single.css" />
    <link rel="stylesheet" href="../style/dist/index.css" />
    <link rel="stylesheet" href="../style/boilerplate.css" />
    <script src="https://kit.fontawesome.com/f5f8362cf6.js" crossorigin="anonymous"></script>
    <title>Pinterest</title>
</head>

<body>
    <div class="navbar">
        <div class="navbar-wrapper">
            <a href="../index.php">
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

    <div class="post-container" id="postCointainer">

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

    <div class="edit-container" id="edit-container">
        <div class="edit">
            <h4>Edit</h4>
            <p id="remove" onclick="toggleEdit()">X</p>


            <div class="container">
                <div class="row">
                    <label>Title</label>
                    <input type="text" placeholder="Title" id="title-edit" value="<?php echo $post['title'] ?>">
                </div>
                <div class="row">
                    <label>Description</label>
                    <textarea type="text" placeholder="Description" id="description-post"><?php echo $post['description'] ?></textarea>
                </div>
                <div class="row">
                    <label>Hastags</label>
                    <input type="text" placeholder="Hashtags" id="hashtags-post" value="<?php echo $post['hashtags'] ?>">
                </div>

                <div class="row">
                    <button type="button" id="update">Update</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        var id = "<?php echo $post['id']; ?>";
        var title = "<?php echo $post['title']; ?>";
        var description = "<?php echo $post['description']; ?>";
        var hashtags = "<?php echo $post['hashtags']; ?>";
        var userID = <?php echo $_SESSION['id'] ?>;
    </script>

    <script src="../script/index.js"></script>
    <script src="../script/search.js"></script>
    <script src="../script/single.js"></script>
    <script src="../script/updatepost.js"></script>;
</body>

</html>