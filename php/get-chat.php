<?php 
session_start();

if(isset($_SESSION['unique_id'])){
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id']; // Oturumdaki kullanıcı (mesajı gönderen)
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // Sohbet edilen diğer kullanıcı

    $output = "";

    // İki kullanıcı arasındaki mesajları getir (gönderici-alıcı veya alıcı-gönderici)
    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
            ORDER BY msg_id";

    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id'] === $outgoing_id){
                // Mesaj göndericiye ait (sağda gösterilen mesaj)
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. htmlspecialchars($row['msg']) .'</p>
                                </div>
                            </div>';
            }else{
                // Gelen mesaj (sol tarafta kullanıcı resmi ve mesaj)
                $output .= '<div class="chat incoming">
                                <img src="php/images/'.htmlspecialchars($row['img']).'" alt="Profil Resmi">
                                <div class="details">
                                    <p>'. htmlspecialchars($row['msg']) .'</p>
                                </div>
                            </div>';
            }
        }
    }else{
        $output .= '<div class="text">Mesaj bulunmamaktadır. Mesaj gönderildiğinde burada görünecektir.</div>';
    }

    echo $output;
}else{
    // Oturum yoksa login sayfasına yönlendir
    header("location: ../login.php");
}
?>
