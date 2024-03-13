<?php
require('../model/config/config.php');

// Permitir solicitudes CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Rescatamos la data enviada por el usuario
    $name = isset($_POST["name"]) ? $_POST["name"] : null;
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : null;
    $username = isset($_POST["username"]) ? $_POST["username"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;

    // Validar datos
    if (empty($name) || empty($lastname) || empty($username) || empty($email) || empty($phone) || empty($password)) {
        // Si faltan campos requeridos, responder con un mensaje de error
        http_response_code(400); // Bad Request
        echo json_encode(array('message' => 'Todos los campos son obligatorios'));
        exit();
    }

    // Sanitizar datos
    $name = htmlspecialchars($name);
    $lastname = htmlspecialchars($lastname);
    $username = htmlspecialchars($username);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $password = htmlspecialchars($password); // Asegúrate de usar una función de hash segura para almacenar la contraseña

    // Verificar integridad de datos (por ejemplo, verificar si el correo electrónico ya existe en la base de datos)

    // Insertar datos en la base de datos (usar consultas preparadas para evitar inyección de SQL)
    // Aquí deberías utilizar PDO o MySQLi con consultas preparadas para insertar los datos en la base de datos
    // Por ejemplo:
    /*
    $stmt = $pdo->prepare("INSERT INTO users (name, lastname, username, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $lastname, $username, $email, $phone, $password]);
    */

    // Si la inserción en la base de datos fue exitosa, responder con un mensaje de éxito
    echo json_encode(array('message' => 'Usuario registrado correctamente'));
} else {
    // Si la solicitud no es de tipo POST, responder con un mensaje de error
    http_response_code(405); // Método no permitido
    echo json_encode(array('message' => 'Método no permitido'));
}
