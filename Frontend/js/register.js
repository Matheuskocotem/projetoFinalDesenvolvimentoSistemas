function showError(message) {
    alert(message);
}

function showSuccess(message) {
    alert(message);
}


async function register() {
    const name = document.getElementById('name').value;
    const surname = document.getElementById("surname").value;
    const email   = document.getElementById('email').value;
    const password  = document.getElementById('password').value;
    const confirmPassword  = document.getElementById('confirmPassword').value;

    if (!name) {
        showError("Por favor, insira seu nome completo.");
        return;
    }

    if (!surname) {
        showError("Por favor, insira seu sobrenome.");
        return;
    }

    if (!email) {
        showError("Por favor, insira um email válido.");
        return;
    }
    if (!password) {
        showError("Por favor, insira uma senha.");
        return;
    }
    if (password !== confirmPassword) {
        showError("As senhas não coincidem.");
        return;
    }

    const response = await fakeRegister(name, surname, email, password);

    if (response == 201) {
        showSuccess("Conta criada com sucesso! Bem-vindo ao Pet Shop!");
        window.location.href = "../views/login.html";
    } else {
        showError("Erro ao criar conta: " + response.message);
    }
}