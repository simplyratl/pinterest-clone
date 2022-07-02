<?php

require('../conn.php');

$postID = $_POST['postID'];
$userID = $_POST['userID'];
$comment = $_POST['comment'];

$sql = $conn->prepare("INSERT INTO comments(comment, user_id, post_id) VALUES(?,?,?)");
$sql->bind_param("sii", $comment, $userID, $postID);

if ($sql->execute()) {
    echo 1;
} else {
    echo 0;
}
$conn->close();
