<?php
require('../conn.php');

$postID = $_POST['postID'];
$userID = $_POST['userID'];

$postSQL = "SELECT * FROM posts WHERE id=$postID";
$resultPost = $conn->query($postSQL);


while ($post = $resultPost->fetch_assoc()) {

    $postOwnerSQL = "SELECT * FROM users WHERE id=" . $post['owner_id'];
    $postOwnerResult = $conn->query($postOwnerSQL);
    $postOwner = $postOwnerResult->fetch_assoc();

?>
    <div class="post-wrapper">
        <div class="image-container">
            <?php
            echo '<img src="data:image/jpeg;base64,' . base64_encode($post['image']) . '" />'
            ?>
        </div>

        <div class="text">
            <div class="owner">
                <div class="left">
                    <?php
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($postOwner['image']) . '" />'
                    ?>
                    <p><?php echo $postOwner['username'] ?></p>
                </div>

                <div class="control">
                    <i class="fa-solid fa-ellipsis" onclick="toggleDropDown()"></i>

                    <div class="control-container" style="display: none;" id="controls">
                        <ul>
                            <li id="download">
                                Download
                            </li>

                            <?php if ($userID == 23 || $userID == $post['owner_id'])
                                echo "<li onclick='toggleEdit()'>
                                        Edit
                                        </li>
                                    <li id='delete'>
                                        Delete
                                    </li>"
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <button type="button" class="save" id="save">Save</button>

            <h3>
                <?php echo $post['title'] ?>
            </h3>

            <p class="description"><?php echo $post['description']; ?></p>

            <p class="hashtags"><?php echo $post['hashtags'] ?></p>

            <div class="comments">
                <div class="comments-wrapper">
                    <h3>Comments</h3>

                    <ul class="comments-list" id="commentsList">
                    </ul>
                </div>

                <div class="input">
                    <input type="text" placeholder="Add a comment..." id="comment">
                    <button id="addComment">Done</button>
                </div>

            </div>
        </div>
    </div>
<?php
    echo '<script src="../script/save.js"></script>';
    echo '<script src="../script/addcomment.js"></script>';
    echo '<script src="../script/download.js"></script>';
    echo '<script src="../script/delete.js"></script>';
}
$conn->close();
