<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sohbet Uygulaması - Kayıt</title>

  <!-- CSS dosyası -->
  <link rel="stylesheet" href="css/index.css" />

  <!-- Font Awesome ikonlar -->
  <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" 
  />
</head>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>✨ Sohbet Uygulaması</header>

      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>

        <div class="name-details">
          <div class="field input">
            <label for="fname">Ad</label>
            <input type="text" id="fname" name="fname" placeholder="Adınızı girin" required>
          </div>
          <div class="field input">
            <label for="lname">Soyad</label>
            <input type="text" id="lname" name="lname" placeholder="Soyadınızı girin" required>
          </div>
        </div>

        <div class="field input">
          <label for="email">E-posta Adresi</label>
          <input type="email" id="email" name="email" placeholder="ornek@domain.com" required>
        </div>

        <div class="field input password-field">
          <label for="password">Şifre</label>
          <input type="password" id="password" name="password" placeholder="Yeni bir şifre oluşturun" required>
          <i class="fas fa-eye"></i>
        </div>

        <div class="field input password-field">
          <label for="confirm_password">Şifre Tekrar</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Şifreyi tekrar girin" required>
          <i class="fas fa-eye"></i>
        </div>

        <div class="field image">
          <label for="image">Profil Fotoğrafı</label>
          <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="field button">
          <input type="submit" name="submit" value="Sohbete Başla">
        </div>
      </form>

      <div class="link-container">
        <div class="link">Zaten hesabınız var mı? <a href="login.php">Giriş yap</a></div>
        <br>
        <div class="link">Şifrenizi mi unuttunuz? <a href="Sifre_yenileme/sifremi_unuttum.php">Şifreyi yenile</a></div>
      </div>
    </section>
  </div>

  <script src="javascript/signup.js"></script>
</body>
</html>
