import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function togglePassword() {
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}

document.addEventListener("DOMContentLoaded", () => {
    const passwordField = document.getElementById("password");
    const togglePasswordBtn = document.getElementById("togglePasswordBtn");
    const toggleIcon = document.getElementById("toggleIcon");

    if (passwordField && togglePasswordBtn && toggleIcon) {
        togglePasswordBtn.addEventListener("click", () => {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.src = "/image/view.png"; // icon "show"
            } else {
                passwordField.type = "password";
                toggleIcon.src = "/image/hidden.png"; // icon "hide"
            }
        });
    }
});
