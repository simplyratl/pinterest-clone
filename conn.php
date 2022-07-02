<?php

$conn = new mysqli('localhost', 'root', '', 'pinterest');

if ($conn->connect_error) {
    echo $conn->connect_error;
} else {
    session_start();
}
