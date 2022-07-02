<?php

require('../conn.php');

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$hashtags = $_POST['hashtags'];

if (strlen($title) === 0) {
    $title = "unknown";
}

$file = fopen('../downloads/' . $title . '.txt', 'w') or die('Unable to open file.');
$text = "ID: " . $id . "\n" . "Title: " . $title . "\n" . "Description: " . $description . "\n" . "Hashtags: " . $hashtags;
fwrite($file, $text);
fclose($file);

echo 1;

$conn->close();
