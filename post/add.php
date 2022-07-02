<?php

require('../conn.php');

$title = $_POST['title'];
$userId = $_POST['id'];
$hashtags = $_POST['hashtags'];
$description = $_POST['description'];

$image = file_get_contents($_FILES['image']['tmp_name']);

if (strlen($image) > 0) {
    $sqlAddPost = $conn->prepare("INSERT INTO posts(title, hashtags , owner_id, image, description) VALUES(?,?,?,?,?)");
    $sqlAddPost->bind_param("ssiss", $title, $hashtags, $userId, $image, $description);

    $sqlAddPost->execute();

    $sqlAddPost->close();
}
