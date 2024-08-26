function showError(message) {
    alert(message);
}

function showSuccess(message) {
    alert(message);
}

async function login() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (!email) {
        showError("Email inválido.");
        return;
    }
    if (!password) {
        showError("Senha inválida.");
        return;
    }

    const response = await fakeLogin(email, password);

    if (response == 200) {
        showSuccess("Login bem-sucedido. Bem-vindo ao Pet Shop!");
        window.location.href = "dashboard.html";
    } else {
        showError("Erro no login: " + response.message);
    }
}

function fakeLogin(email, password) {
    return new Promise((resolve) => {
        setTimeout(() => {
            if (email === "petlover@example.com" && password === "mypassword") {
                resolve(200);
            } else {
                resolve({ message: "Credenciais inválidas." });
            }
        }, 1000);
    });
}
