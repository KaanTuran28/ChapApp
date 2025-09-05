<?php 
session_start();
include_once "config.php";

// Kullanıcıdan gelen email ve şifreyi güvenli hale getir
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Alanların boş olup olmadığını kontrol et
if (!empty($email) && !empty($password)) {
    // Email'e göre kullanıcıyı bul
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        // Girilen şifreyi md5 ile şifrele
        $user_pass = md5($password);
        $enc_pass = $row['password'];

        // Şifre karşılaştırması
        if ($user_pass === $enc_pass) {
            $status = "Active now";
            // Kullanıcının durumunu güncelle
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

            if ($sql2) {
                // Oturuma unique_id kaydet
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success"; // Giriş başarılı
            } else {
                echo "Bir hata oluştu. Lütfen tekrar deneyin!";
            }
        } else {
            echo "Email veya şifre yanlış!";
        }
    } else {
        echo "$email - Bu email kayıtlı değil!";
    }
} else {
    echo "Tüm alanların doldurulması zorunludur!";
}
?>
