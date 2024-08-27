<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petideal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST['name']);
    $surname = sanitizeInput($_POST['surname']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

  
    if ($password !== $confirmPassword) {
        echo "As senhas não coincidem.";
        exit();
    }

 
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $surname, $email, $hashedPassword);


    if ($stmt->execute()) {
        header("Location: ../frontend/views/login.html");
        exit();
    } else {
        echo "Erro ao criar conta: " . $stmt->error;
    }


    $stmt->close();
}

$conn->close();