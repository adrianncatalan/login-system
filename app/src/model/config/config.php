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

// Convirtiendo los datos que provienen de la BBDD utf8
mysqli_set_charset($conn, "utf8");

// echo 'Successful connection!';
