const form = document.querySelector(".signup form");
const errorText = form.querySelector(".error-text");

const passwordField = form.querySelector("input[name='password']");
const confirmField = form.querySelector("input[name='confirm_password']");
const toggleIconPassword = form.querySelector("input[name='password'] + i");
const toggleIconConfirm = form.querySelector("input[name='confirm_password'] + i");

function togglePasswordVisibility(field, toggleIcon) {
  if (field.type === "password") {
    field.type = "text";
    toggleIcon.classList.add("active");
    toggleIcon.classList.remove("fa-eye");
    toggleIcon.classList.add("fa-eye-slash");
  } else {
    field.type = "password";
    toggleIcon.classList.remove("active");
    toggleIcon.classList.remove("fa-eye-slash");
    toggleIcon.classList.add("fa-eye");
  }
}

toggleIconPassword.onclick = () => {
  togglePasswordVisibility(passwordField, toggleIconPassword);
}

toggleIconConfirm.onclick = () => {
  togglePasswordVisibility(confirmField, toggleIconConfirm);
}

form.addEventListener("submit", e => {
  e.preventDefault();

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/signup.php", true);

  xhr.onload = () => {
    if (xhr.status === 200) {
      const data = xhr.response.trim();
      if (data === "success") {
        window.location.href = "users.php";
      } else {
        errorText.style.display = "block";
        errorText.textContent = data;
      }
    } else {
      errorText.style.display = "block";
      errorText.textContent = "Sunucu hatası, lütfen daha sonra tekrar deneyin.";
    }
  };

  xhr.onerror = () => {
    errorText.style.display = "block";
    errorText.textContent = "Bağlantı hatası, lütfen internet bağlantınızı kontrol edin.";
  };

  const formData = new FormData(form);
  xhr.send(formData);
});
