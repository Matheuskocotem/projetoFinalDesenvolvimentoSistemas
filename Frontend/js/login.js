function login() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const errorMessage = document.getElementById("errorMessage");

    fetch("../backend/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            window.location.href = "../frontend/views/cart.php";
        } else {
            errorMessage.style.display = "block";
        }
    })
    .catch(error => {
        console.error("Erro:", error);
        errorMessage.style.display = "block";
    });
}
