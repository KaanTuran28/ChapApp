const form = document.querySelector(".login form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-text");

// Şifre alanı ve ikon
const passwordField = form.querySelector("input[name='password']");
const toggleIconPassword = form.querySelector("input[name='password'] + i");

// Şifreyi göster/gizle fonksiyonu
function togglePasswordVisibility(field, icon) {
  const isPassword = field.type === "password";
  field.type = isPassword ? "text" : "password";
  icon.classList.toggle("fa-eye", !isPassword);
  icon.classList.toggle("fa-eye-slash", isPassword);
}

// Göz ikonuna tıklama
toggleIconPassword.onclick = () => togglePasswordVisibility(passwordField, toggleIconPassword);

// Form gönderimini engelle
form.onsubmit = (e) => {
  e.preventDefault();
};

// Giriş butonu tıklanınca AJAX ile gönder
continueBtn.onclick = () => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const data = xhr.response.trim();
      if (data === "success") {
        location.href = "users.php";
      } else {
        errorText.style.display = "block";
        errorText.textContent = data;
      }
    }
  };

  const formData = new FormData(form);
  xhr.send(formData);
};
