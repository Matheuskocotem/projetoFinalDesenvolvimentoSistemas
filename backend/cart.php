<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: ../frontend/views/login.html");
    exit();
}

echo "Este é o seu carrinho, " . $_SESSION['email'] . ".";

