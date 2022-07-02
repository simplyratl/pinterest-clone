<?php
require('../conn.php');

$username = $_POST['username'];
$email = $_POST['email'];
$userID = $_POST['userID'];

$sql = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
$sql->bind_param("ssi", $username, $email, $userID);

if ($sql->execute()) {
    echo 1;
} else {
    echo 0;
}

$conn->close();
