<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE unique_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $img = $row['img'];
} else {
    echo "Kullanıcı bilgileri alınamadı.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['delete'])) {
    $new_fname = trim($_POST['fname']);
    $new_lname = trim($_POST['lname']);
    $new_email = trim($_POST['email']);

    // Görsel yükleme işlemi
    $new_img = $img;
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img_ext = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($img_ext, $allowed)) {
            $new_img = uniqid("img_") . "." . $img_ext;
            $upload_path = "php/images/" . $new_img;
            move_uploaded_file($_FILES['img']['tmp_name'], $upload_path);
        }
    }

    $update_sql = "UPDATE users SET fname = '$new_fname', lname = '$new_lname', email = '$new_email', img = '$new_img' WHERE unique_id = '$user_id'";
    if ($conn->query($update_sql)) {
        header("Location: profil.php");
        exit();
    } else {
        echo "Güncelleme başarısız: " . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $conn->query("DELETE FROM users WHERE unique_id = '$user_id'");
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Profil Ayarları</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/profil.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Profil Ayarları</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="profile-photo">
                <img src="php/images/<?php echo htmlspecialchars($img); ?>" alt="Profil Fotoğrafı">
            </div>

            <label>Ad:</label>
            <input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>" required>

            <label>Soyad:</label>
            <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label>Yeni Profil Fotoğrafı:</label>
            <input type="file" name="img" accept="image/*">

            <div class="button-group">
                <button type="submit">Güncelle</button>
                <button type="submit" name="delete" onclick="return confirm('Profilinizi silmek istediğinize emin misiniz?')">Sil</button>
                <a href="users.php" class="back-link">Geri Dön</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
