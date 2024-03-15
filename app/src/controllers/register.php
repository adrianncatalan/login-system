<?php
// Requerimos la conexión a la BBDD para realizar las operaciones
require('../model/config/config.php');

// Usamos la variable global &_SERVER para verificar que el método usado ha sido POST
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Verificar si los campos del formulario estan definidos y no son vacíos
    $name = isset($_POST["name"]) && !empty($_POST["name"]) ? $_POST["name"] : null;
    $lastname = isset($_POST["lastname"]) && !empty($_POST["lastname"]) ? (!empty($_POST["lastname"])) : null;
    $username = isset($_POST["username"]) && !empty($_POST["username"]) ? $_POST["username"] : null;
    $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : null;
    $phone = isset($_POST["phone"]) && !empty($_POST["phone"]) ? $_POST["phone"] : null;
    $password = isset($_POST["password"])  && !empty($_POST["password"]) ? $_POST["password"] : null;

    // Aplicamos funciones de sanitizado para los los campos que provienen del frontend
    $name = htmlspecialchars($name);
    $lastname = htmlspecialchars($lastname);
    $username = htmlspecialchars($username);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $password = htmlspecialchars($password);

    // Verificar integridad de datos (por ejemplo, verificar si el username, email y phone ya existe en la base de datos)
    // Realizamos una consult
    $verifyQuery = 'SELECT username, email, phone FROM `user`';
    $result = mysqli_query($conn, $verifyQuery);
    $data[] = mysqli_fetch_assoc($result);

    if ($data[0]['username'] === $name || $data[0]['email'] === $email || $data[0]['phone'] === $phone) {
        echo 'The username, email or phone number is being used by another user. Please enter new information.';
    } else {
        $insertQuery = "INSERT INTO `user` (`id`, `name`, `lastname`, `username`, `email`, `phone`, `password`, `created_at`, `user_exist`) VALUES (uuid(), $name, $lastname, $username, $email, $phone, $password, now(), 1)";
        if (mysqli_query($conn, $insertQuery)) {
            echo 'Record inserted successfully.';
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

    // Cerramos la conexión
    mysqli_close($conn);
}
