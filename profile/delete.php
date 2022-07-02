<?php
require('../conn.php');

$userID = $_POST['userID'];

$sqlDeletePost = $conn->prepare("DELETE FROM users WHERE id = ?");
$sqlDeletePost->bind_param("i", $userID);

if ($sqlDeletePost->execute()) {
    echo 1;
} else {
    echo $sqlDeletePost->error;
}

$conn->close();
