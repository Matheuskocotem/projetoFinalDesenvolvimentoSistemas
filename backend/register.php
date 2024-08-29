<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petideal";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para sanitizar entradas
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST['name']);
    $surname = sanitizeInput($_POST['surname']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    // Verificar se as senhas coincidem
    if ($password !== $confirmPassword) {
        echo "As senhas não coincidem.";
        exit();
    }

    // Verificar se o email já está registrado
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Este email já está registrado.";
        exit();
    }
    $stmt->close();

    // Criptografar a senha
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Inserir o novo usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $surname, $email, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../frontend/views/login.html?success=1");
        exit();
    } else {
        echo "Erro ao criar conta: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

