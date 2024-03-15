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

    // Consulta preparada para verificar si los datos ya existen en la base de datos
    $verifyQuery = "SELECT username, email, phone FROM `user`";
    $stmt = mysqli_prepare($conn, $verifyQuery);

    if ($stmt) {
        // Ejecutar la consulta preparada
        mysqli_stmt_execute($stmt);

        // Vincular variables para almacenar los resultados
        mysqli_stmt_bind_result($stmt, $existingUsername, $existingEmail, $existingPhone);

        // Inicializar una variable para verificar si los datos ya existen
        $dataExists = false;

        // Recorrer los resultados
        while (mysqli_stmt_fetch($stmt)) {
            // Verificar si los datos ya existen en la base de datos
            if ($existingUsername === $username || $existingEmail === $email || $existingPhone === $phone) {
                $dataExists = true;
                break; // Salir del bucle si se encuentra un dato existente
            }
        }

        // Cerrar el objeto de sentencia preparada
        mysqli_stmt_close($stmt);

        // Insertar los datos si no existen en la base de datos
        if (!$dataExists) {
            // Consulta preparada para insertar los datos
            $insertQuery = "INSERT INTO `user` (`id`, `name`, `lastname`, `username`, `email`, `phone`, `password`, `created_at`, `user_exist`) VALUES (uuid(), ?, ?, ?, ?, ?, ?, NOW(), 1)";
            $stmt = mysqli_prepare($conn, $insertQuery);

            // Vincular los parámetros de la consulta preparada
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $lastname, $username, $email, $phone, $password);

            // Ejecutar la consulta preparada de inserción
            if (mysqli_stmt_execute($stmt)) {
                echo 'Record inserted successfully.';
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }

            // Cerrar el objeto de sentencia preparada
            mysqli_stmt_close($stmt);
        } else {
            echo 'The username, email, or phone number is being used by another user. Please enter new information.';
        }
    } else {
        // Manejar errores en caso de que la preparación de la consulta falle
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }

    // Cerramos la conexión
    mysqli_close($conn);
}
