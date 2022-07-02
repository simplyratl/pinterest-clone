<?php
require('../conn.php');

$postID = $_POST['postID'];

$sqlDeletePost = $conn->prepare("DELETE FROM posts WHERE id = ?");
$sqlDeletePost->bind_param("i", $postID);

if ($sqlDeletePost->execute()) {
    echo 1;
} else {
    echo $sqlDeletePost->error;
}

$conn->close();
