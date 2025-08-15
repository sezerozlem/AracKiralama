const loginButton = document.getElementById("loginButton");
const registerButton = document.getElementById("registerButton");
const loginModal = document.getElementById("loginModal");
const registerModal = document.getElementById("registerModal");
const closeLogin = document.getElementById("closeLogin");
const closeRegister = document.getElementById("closeRegister");

loginButton?.addEventListener("click", () => {
    loginModal.style.display = "flex";
});
registerButton?.addEventListener("click", () => {
    registerModal.style.display = "flex";
});

closeLogin?.addEventListener("click", () => {
    loginModal.style.display = "none";
});
closeRegister?.addEventListener("click", () => {
    registerModal.style.display = "none";
});

document.getElementById('registerUserForm')?.addEventListener('submit', function(event) {
    const password = document.getElementById('registerPassword').value;
    const passwordRepeat = document.getElementById('registerPasswordRepeat').value;
    if (password !== passwordRepeat) {
        event.preventDefault();
        alert('Şifreler uyuşmuyor. Lütfen tekrar girin.');
    }
});
