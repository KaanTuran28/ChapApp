<?php
session_start();
include_once "config.php";

// Kullanıcıdan gelen POST verilerini güvenli hale getiriyoruz
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

// Boş alan kontrolü
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    // Email format kontrolü
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Şifrelerin eşleşme kontrolü
        if ($password == $confirm_password) {
            // Emailin veritabanında olup olmadığını kontrol et
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                echo "$email - Bu email zaten kayıtlı!";
            } else {
                // Resim dosyası yüklendi mi kontrol et
                if (isset($_FILES['image'])) {
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    // Dosya uzantısını al
                    $img_explode = explode('.', $img_name);
                    $img_ext = strtolower(end($img_explode));

                    // Kabul edilen dosya uzantıları
                    $extensions = ["jpeg", "png", "jpg"];

                    if (in_array($img_ext, $extensions) === true) {
                        // Kabul edilen MIME tipleri
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if (in_array($img_type, $types) === true) {
                            $time = time();
                            $new_img_name = $time . $img_name; // Benzersiz isim oluştur
                            // Dosyayı images klasörüne taşı
                            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                                $ran_id = rand(time(), 100000000); // Kullanıcıya rastgele unique_id üret
                                $status = "Active now"; // Başlangıç durumu
                                $encrypt_pass = md5($password); // Şifreyi md5 ile şifrele
                                
                                // Veritabanına ekle
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                                
                                if ($insert_query) {
                                    // Yeni kaydı tekrar çek
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if (mysqli_num_rows($select_sql2) > 0) {
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id']; // Oturuma unique_id ata
                                        echo "success"; // Kayıt başarılı mesajı
                                    } else {
                                        echo "Bu email adresi bulunamadı!";
                                    }
                                } else {
                                    echo "Bir hata oluştu. Lütfen tekrar deneyin!";
                                }
                            }
                        } else {
                            echo "Lütfen jpeg, png veya jpg formatında bir resim yükleyin!";
                        }
                    } else {
                        echo "Lütfen jpeg, png veya jpg formatında bir resim yükleyin!";
                    }
                }
            }
        } else {
            echo "Şifreler uyuşmuyor!";
        }
    } else {
        echo "$email geçerli bir email adresi değil!";
    }
} else {
    echo "Tüm alanların doldurulması zorunludur!";
}
?>
