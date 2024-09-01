<?php
session_start();


$conexao = mysqli_connect('localhost', 'root', '', 'petideal');

if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$name = mysqli_real_escape_string($conexao, $_POST['name']);
$surname = mysqli_real_escape_string($conexao, $_POST['surname']);
$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$password = mysqli_real_escape_string($conexao, $_POST['password']);
$confirmPassword = mysqli_real_escape_string($conexao, $_POST['confirmPassword']);
$phone = mysqli_real_escape_string($conexao, $_POST['phone']);
$address = mysqli_real_escape_string($conexao, $_POST['address']);
$city = mysqli_real_escape_string($conexao, $_POST['city']);
$state = mysqli_real_escape_string($conexao, $_POST['state']);
$zip_code = mysqli_real_escape_string($conexao, $_POST['zip_code']);


if ($password !== $confirmPassword) {
    echo "As senhas não coincidem!";
    echo "<br><a href='register.html'>Tentar Novamente</a>";
    exit();
}

$sql_check = "SELECT * FROM users WHERE email = '$email' OR cpf = '$cpf'";
$result_check = mysqli_query($conexao, $sql_check);
if (mysqli_num_rows($result_check) > 0) {
    echo "Usuário já registrado com este CPF ou email.";
    echo "<br><a href='register.html'>Tentar Novamente</a>";
    exit();
}

// Hash da senha
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insere os dados na tabela de usuários
$sql_insert = "INSERT INTO users (name, surname, cpf, email, password, phone, address, city, state, zip_code) 
               VALUES ('$name', '$surname', '$cpf', '$email', '$password_hashed', '$phone', '$address', '$city', '$state', '$zip_code')";

if (mysqli_query($conexao, $sql_insert)) {
    echo "Registro efetuado com sucesso!";
    header('Location: /Teste-projetofinal/backend/login.html'); // Redireciona para a página de login
} else {
    echo "Erro ao registrar: " . mysqli_error($conexao);
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);

