<?php
while($row = mysqli_fetch_assoc($query)){
    // Her kullanıcı için o kullanıcıyla oturumdaki kullanıcı arasındaki son mesajı getir
    $sql2 = "SELECT * FROM messages WHERE 
            (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) 
            AND 
            (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) 
            ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);

    // Eğer mesaj varsa mesajı al, yoksa "Mesaj yok" yaz
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="Mesaj yok";

    // Mesaj uzunluğu 28 karakterden fazla ise kısalt ve sonuna "..." ekle
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;

    // Son mesajın göndericisi oturumdaki kullanıcı mı kontrol et
    if(isset($row2['outgoing_msg_id'])){
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Sen: " : $you = "";
    }else{
        $you = "";
    }

    // Kullanıcının durumu "Offline now" ise CSS için sınıf ata
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

    // Eğer listelediğimiz kullanıcı oturumdaki kullanıcı ise gizle (CSS için)
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    // Kullanıcı bilgilerini ve son mesajı içeren HTML yapısını oluştur
    $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                <div class="content">
                <img src="php/images/'. $row['img'] .'" alt="Profil Resmi">
                <div class="details">
                    <span>'. $row['fname']. " " . $row['lname'] .'</span>
                    <p>'. $you . $msg .'</p>
                </div>
                </div>
                <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
            </a>';
}
?>
