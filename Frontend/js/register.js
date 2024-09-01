document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#form');
    const messageArea = document.getElementById('messageArea');

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
            const response = await fetch('http://localhost/Teste-projetofinal/backend/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    name: name,
                    surname: surname,
                    cpf: cpf,
                    email: email,
                    password: password,
                    confirmPassword: confirmPassword,
                    phone: phone,
                    address: address,
                    city: city,
                    state: state,
                    zip_code: zipCode
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

    function showError(message) {
        messageArea.textContent = message;
        messageArea.style.color = 'red';
        messageArea.style.display = 'block';
    }

    function showSuccess(message) {
        messageArea.textContent = message;
        messageArea.style.color = 'green';
        messageArea.style.display = 'block';
    }

    function formatCPF(value) {
        return value
            .replace(/\D/g, '') // Remove tudo o que não é dígito
            .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona o primeiro ponto
            .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona o segundo ponto
            .replace(/(\d{3})(\d)/, '$1-$2') // Adiciona o hífen
            .replace(/(-\d{2})\d+$/, '$1'); // Limita o tamanho
    }

    function formatPhone(value) {
        return value
            .replace(/\D/g, '') // Remove tudo o que não é dígito
            .replace(/^(\d{2})(\d)/, '($1) $2') // Adiciona o parêntese e espaço
            .replace(/(\d{4})(\d)/, '$1-$2') // Adiciona o hífen
            .replace(/(-\d{4})\d+$/, '$1'); // Limita o tamanho
    }

    function formatCEP(value) {
        return value
            .replace(/\D/g, '') // Remove tudo o que não é dígito
            .replace(/(\d{5})(\d)/, '$1-$2') // Adiciona o hífen
            .replace(/(-\d{3})\d+$/, '$1'); // Limita o tamanho
    }

    const cpfInput = document.getElementById('cpf');
    const phoneInput = document.getElementById('phone');
    const zipCodeInput = document.getElementById('zip_code');

    cpfInput.addEventListener('input', function (e) {
        e.target.value = formatCPF(e.target.value);
    });

    phoneInput.addEventListener('input', function (e) {
        e.target.value = formatPhone(e.target.value);
    });

    zipCodeInput.addEventListener('input', function (e) {
        e.target.value = formatCEP(e.target.value);
    });
});
