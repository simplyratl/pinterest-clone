<?php
require('../conn.php');

$title = $_POST['title'];
$description = $_POST['description'];
$hashtags = $_POST['hashtags'];
$postID = $_POST['postID'];

$sql = $conn->prepare("UPDATE posts SET title=?, description=?, hashtags=? WHERE id=?");
$sql->bind_param("sssi", $title, $description, $hashtags, $postID);

$sql->execute();

$conn->close();
