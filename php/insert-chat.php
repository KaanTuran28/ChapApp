<?php 
session_start();

// Kullanıcı oturumu varsa devam et
if(isset($_SESSION['unique_id'])){
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id']; // Mesajı gönderen kullanıcı ID'si
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // Mesajın gönderileceği kullanıcı ID'si
    $message = mysqli_real_escape_string($conn, $_POST['message']); // Mesaj içeriği

    // Mesaj boş değilse veritabanına ekle
    if(!empty($message)){
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                    VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die("Sorgu Hatası");
    }
}else{
    // Oturum yoksa login sayfasına yönlendir
    header("location: ../login.php");
}
?>
