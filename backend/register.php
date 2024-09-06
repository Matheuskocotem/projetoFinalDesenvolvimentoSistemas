<?php

$conexao = mysqli_connect('localhost', 'root', '', 'petshoop');


if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}


$nome = mysqli_real_escape_string($conexao, $_POST['name']);
$sobrenome = mysqli_real_escape_string($conexao, $_POST['surname']);
$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, password_hash($_POST['password'], PASSWORD_DEFAULT)); 
$confirmarSenha = $_POST['confirmPassword'];

// Verificação se as senhas coincidem
if ($_POST['password'] !== $confirmarSenha) {
    echo "<script>alert('As senhas não coincidem!'); window.location.href='../frontend/register.html';</script>";
    exit();
}

// Verificação se o CPF já está registrado
$sql = "SELECT cpf FROM clientes WHERE cpf = '$cpf'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<script>alert('CPF já cadastrado!'); window.location.href='../frontend/register.html';</script>";
    exit();
}

// Inserção no banco de dados
$sql = "INSERT INTO clientes (nome, sobrenome, cpf, email, senha, telefone, endereco, cidade, estado, cep) 
        VALUES ('$nome', '$sobrenome', '$cpf', '$email', '$senha', '$telefone', '$endereco', '$cidade', '$estado', '$cep')";

if (mysqli_query($conexao, $sql)) {
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../frontend/login.html';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "'); window.location.href='../frontend/register.html';</script>";
}


mysqli_close($conexao);
