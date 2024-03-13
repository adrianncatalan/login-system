<?php
require(__DIR__ . '\paramaters.php');

$conn = mysqli_connect(
    DB_HOST,
    DB_USER,
    DB_PASSWORD,
    DB_NAME,
    DB_PORT
);

if (!$conn) die('Connection error: ' . mysqli_connect_error());

echo 'Successful connection!';
