<?php
$adminsorgusu = $db->prepare("select * from yonetici where user_adi ='$_SESSION[admin_username]'");
$adminsorgusu->execute();
?>