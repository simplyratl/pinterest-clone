<?php
require('../conn.php');

$selectedOption = $_POST['selectedOption'];
$userID = $_POST['userID'];

$sql = "";

if ($selectedOption == "Created") {
    $sql = "SELECT * FROM posts WHERE owner_id=$userID";
} else {
    $sql = "SELECT * FROM saves WHERE saver_id=$userID";
}

$result = $conn->query($sql);

if ($selectedOption == "Created") {

    while ($posts = $result->fetch_assoc()) {
?>
        <a href="../pages/single.php?id=<?php echo $posts['id'] ?>">
            <?php
            echo '<img src="data:image/jpeg;base64,' . base64_encode($posts['image']) . '" class="avatar-picture" />'
            ?>
        </a>
        <?php
    }
} else {
    while ($saved = $result->fetch_assoc()) {
        $getPost = "SELECT * FROM posts WHERE id=" . $saved['post_id'];
        $getPostResult = $conn->query($getPost);

        while ($post = $getPostResult->fetch_assoc()) {
        ?>
            <a href="../pages/single.php?id=<?php echo $post['id'] ?>">
                <?php
                echo '<img src="data:image/jpeg;base64,' . base64_encode($post['image']) . '" class="avatar-picture" />'
                ?>
            </a>
<?php
        }
    }
}


$conn->close();
