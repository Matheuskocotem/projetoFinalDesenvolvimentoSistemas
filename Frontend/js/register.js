document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#form');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const surname = document.getElementById('surname').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

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

        try {
            const response = await fetch('../../backend/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    name: name,
                    surname: surname,
                    email: email,
                    password: password,
                    confirmPassword: confirmPassword
                })
            });

            const result = await response.text();

            if (response.ok) {
                showSuccess("Conta criada com sucesso! Bem-vindo ao Pet Shop!");
                window.location.href = "../views/login.html";
            } else {
                showError("Erro ao criar conta: " + result);
            }
        } catch (error) {
            console.error("Erro ao enviar requisição:", error);
            showError("Ocorreu um erro ao tentar criar a conta.");
        }
    });
});

function showError(message) {
    alert(message);
}

function showSuccess(message) {
    alert(message);
}
