<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sohbet Uygulaması - Giriş</title>
  
  <!-- CSS dosyasını buraya bağla -->
  <link rel="stylesheet" href="css/login.css" />
  
  <!-- Font Awesome ikonları için -->
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
    <section class="form login">
      <header>✨ Sohbet Uygulaması</header>

      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" id="login-form">
        <div class="error-text"></div>

        <div class="field input">
          <label for="email">Email Adresi</label>
          <input type="text" id="email" name="email" placeholder="Email adresinizi girin" required>
        </div>

        <div class="field input password-field">
          <label for="password">Şifre</label>
          <input type="password" id="password" name="password" placeholder="Şifrenizi girin" required>
          <i class="fas fa-eye"></i>
        </div>

        <div class="field button">
          <input type="submit" name="submit" value="Sohbete Devam Et">
        </div>
      </form>

      <div class="link-container">
        <div class="link">Henüz kayıt olmadınız mı? <a href="index.php">Kayıt Ol</a></div>
        <br>
        <div class="link">Şifrenizi mi unuttunuz? <a href="Sifre_yenileme/sifremi_unuttum.php">Şifre Yenile</a></div>
      </div>
    </section>
  </div>
  <script src="javascript/login.js"></script>
</body>
</html>
