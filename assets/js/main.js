document.addEventListener("DOMContentLoaded", () => {
    const formRegistro = document.getElementById("formRegistro");
    if (formRegistro) {
        formRegistro.addEventListener("submit", (e) => {
            const password = document.getElementById("password").value;
            const confirmarPassword = document.getElementById("confirmar_password").value;

            if (password !== confirmarPassword) {
                alert("Las contraseñas no coinciden. Por favor, verifíquelas.");
                e.preventDefault();
            }
        });
    }

    const inputs = document.querySelectorAll("input[required]");
    inputs.forEach(input => {
        input.addEventListener("invalid", () => {
            input.setCustomValidity("Este campo es obligatorio.");
        });
        input.addEventListener("input", () => {
            input.setCustomValidity("");
        });
    });
});