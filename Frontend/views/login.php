<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'petideal';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["signin"])) {
        $email = $conn->real_escape_string($_POST["email"]);
        $password = $_POST["password"];

        $query = "SELECT password FROM users WHERE email='$email'";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                header("Location: dashboard.html");
                echo "Login successful!";
            } else {
                echo "Invalid credentials.";
            }
        } else {
            echo "No user found.";
        }
    } elseif (isset($_POST["signup"])) {
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    
        $query = "SELECT id FROM users WHERE email='$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "User already exists.";
        } else {
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($query) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem vindo de volta!</h2>
                <p class="description description-primary">Para se manter conectado conosco,</p>
                <p class="description description-primary">por favor faça login com suas informações pessoais</p>
                <button id="signin" class="btn btn-primary">Entre</button>
            </div>    
            <div class="second-column">
                <h2 class="title title-second">Crie sua conta</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>        
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul>
                </div>
                <p class="description description-second">ou use seu e-mail para registro:</p>
                <form class="form" id="signupForm" method="POST">
                    <label class="label-input" for="name">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="name" placeholder="Name" required>
                    </label>
                    
                    <label class="label-input" for="signupEmail">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </label>
                    
                    <label class="label-input" for="signupPassword">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </label>
                    
                    <button type="submit" name="signup" class="btn btn-second">sign up</button>        
                </form>
            </div>
        </div>
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, amigo!</h2>
                <p class="description description-primary">Insira seus dados pessoais</p>
                <p class="description description-primary">e comece sua jornada conosco</p>
                <button id="signup" class="btn btn-primary">cadastre-se</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Entre</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul>
                </div>
                <p class="description description-second">ou use sua conta de e-mail:</p>
                <form class="form" id="signinForm" method="POST">
                    <label class="label-input" for="signinEmail">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </label>
                
                    <label class="label-input" for="signinPassword">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </label>
                
                    <a class="password" href="#">Esqueceu sua senha?</a>
                    <button type="submit" name="signin" class="btn btn-second">Entrar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>
