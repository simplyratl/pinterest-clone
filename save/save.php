<?php
require('../conn.php');

$userID = $_POST['userID'];
$postID = $_POST['postID'];
$firstLoad = $_POST['firstLoad'];

$checkAdded = "SELECT * FROM saves WHERE saver_id = $userID AND post_id = $postID";
$resultCheckAdded = $conn->query($checkAdded);

if ($firstLoad == "0") {
    if ($resultCheckAdded->num_rows > 0) {
        $sqlDeleteSave = $conn->prepare("DELETE FROM saves WHERE saver_id = ? AND post_id = ?");
        $sqlDeleteSave->bind_param("ii", $userID, $postID);
        $sqlDeleteSave->execute();
        echo 0;
    } else {
        $sqlSavePost = $conn->prepare("INSERT INTO saves(post_id, saver_id) VALUES(?, ?)");
        $sqlSavePost->bind_param("ii", $postID, $userID);
        $sqlSavePost->execute();
        echo 1;
    }
} else if ($firstLoad == "1") {
    $sqlGetSaved = "SELECT * FROM saves WHERE saver_id = $userID AND post_id = $postID";
    $sqlResult = $conn->query($sqlGetSaved);

    if ($sqlResult->fetch_assoc()) {
        echo 1;
    } else {
        echo 0;
    }
}

$conn->close();
