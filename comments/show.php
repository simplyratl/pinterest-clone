<?php
require('../conn.php');

$postID = $_POST['postID'];

$sql = "SELECT * FROM comments WHERE post_id=$postID";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $getUser = "SELECT * FROM users WHERE id=" . $row['user_id'];
    $userResult = $conn->query($getUser);
    $user = $userResult->fetch_assoc();
?>
    <li>
        <p class="comment">
        <div class="user">
            <a href="./profile.php?id=<?php echo $user['id']; ?>">
                <?php
                echo '<img src="data:image/jpeg;base64,' . base64_encode($user['image']) . '" />'
                ?>

                <p class="username"><?php echo $user['username'] ?></p>
            </a>
        </div>
        <p><?php echo $row['comment'] ?></p>
    </li>
<?php
}
?>