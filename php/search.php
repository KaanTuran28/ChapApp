<?php
    session_start();
    include_once "config.php";

    // Oturumdan aktif kullanıcının unique_id'sini al
    $outgoing_id = $_SESSION['unique_id'];

    // Arama terimini güvenli hale getir
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // Kendisi hariç, isim veya soyisim arama terimiyle eşleşen kullanıcıları getir
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    
    $output = "";
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0){
        // Eşleşen kullanıcılar varsa data.php'yi dahil et (muhtemelen listeyi oluşturuyor)
        include_once "data.php";
    } else {
        $output .= 'Arama teriminizle ilgili kullanıcı bulunamadı';
    }

    echo $output;
?>
